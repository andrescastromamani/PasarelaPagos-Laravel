<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Currency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            'usd',
            'eur',
            'gbp',
            'jpy'
        ];
        foreach ($currencies as $currency){
            \App\Models\Currency::create([
                'iso'=>$currency
            ]);
        }
    }
}
