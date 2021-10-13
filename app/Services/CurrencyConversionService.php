<?php

namespace App\Services;

use App\Traits\ConsumesExtenalServices;
use Illuminate\Http\Request;

class CurrencyConversionService
{
    use ConsumesExtenalServices;

    protected $baseUri;
    protected $key;

    public function __construct()
    {
        $this->baseUri = config('services.currency_conversion.base_uri');
        $this->key = config('services.currency_conversion.apiKey');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['apiKey'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return $this->key;
    }

    public function convertCurrency($from, $to)
    {
        $response = $this->makeRequest(
            'GET',
            '/api/v7/convert',
            [
                'q' => "{$from}_{$to}",
                'compact' => 'ultra'
            ]
        );
        return $response->{strtoupper("{$from}_{$to}")};
    }
}
