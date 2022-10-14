<?php

namespace App\Traits;
use Auth;

trait StripeTrait {

    public static function obj($sales_company = null) 
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        return $stripe;
    }
}