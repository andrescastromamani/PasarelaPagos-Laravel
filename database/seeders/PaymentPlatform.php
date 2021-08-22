<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentPlatform extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PaymentPlatform::create([
            'name'=>'PayPal',
            'image'=>'img/payment-platforms/paypal.jpg'
        ]);
        \App\Models\PaymentPlatform::create([
            'name'=>'Stripe',
            'image'=>'img/payment-platforms/stripe.jpg'
        ]);
    }
}
