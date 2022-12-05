<?php

namespace App\Traits;
use Auth;

trait StripeTrait {

    public static function obj($sales_company = null) 
    {
        $stripe = new \Stripe\StripeClient('sk_test_51KrPyXJYj0C4VBCc5VOTUbBbN8J6ndaKGrfhzrufEDSKPVvHrNedkuQ5F3tMfwMJ3ernFauBxBkwHu9LgUUZtDOW00mXUJJ8Uw');
        return $stripe;
    }
}