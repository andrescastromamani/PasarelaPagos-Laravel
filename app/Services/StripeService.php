<?php

namespace App\Services;

use App\Traits\ConsumesExtenalServices;
use Illuminate\Http\Request;

class StripeService
{
    use ConsumesExtenalServices;

    protected $baseUri;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return "Bearer {$this->secret}";
    }

    public function handlePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);
        $intent = $this->createIntent($request->value, $request->currency, $request->payment_method);
        session()->put('paymentIntentId', $intent->id);
        return redirect()->route('approval');
    }

    public function handleApproval()
    {
        if (session()->has('paymentIntentId')) {
            $paymentIntentId = session()->get('paymentIntentId');
            $confirmation = $this->confirmPayment($paymentIntentId);
            if ($confirmation->status == 'requires_action') {
                $clientSecret = $confirmation->client_secret;
                return view('stripe.3d-secure', compact('clientSecret'));
            }
            if ($confirmation->status === 'succeeded') {
                $name = $confirmation->charges->data[0]->billing_details->name;
                $currency = strtoupper($confirmation->currency);
                $amount = $confirmation->amount / $this->resolveFactor($currency);
                return redirect()->route('home')->withSuccess([
                    'payment' => "thanks {$name}. we received your {$amount} {$currency} payment."
                ]);
            }
        }
        return redirect()->route('home')->withErrors('We cannot capture your payment. Try again, please');
    }

    public function createIntent($value, $currency, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [],
            [
                'amount' => round($value * $this->resolveFactor($currency)),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual'
            ],
        );
    }

    public function confirmPayment($paymentIntenId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntenId}/confirm",
        );
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];
        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }
        return 100;
    }
}
