<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'paypal-ipn',
        'paytm-ipn',
        'event-paypal-ipn',
        'event-paytm-ipn',
        'product-paypal-ipn',
        'product-paytm-ipn',
        'donation-paypal-ipn',
        'donation-paytm-ipn',
        'gig-paypal-ipn',
        'gig-paytm-ipn',
        'admin-home/update-static-option',
        'admin-home/get-static-option',
        'admin-home/set-static-option',
        'payfast-ipn',
        'cashfree-ipn',
        'donation-razorpay-ipn',
        'donation-payfast-ipn',
        'donation-cashfree-ipn',

        'product-paystack-ipn',
        'product-cashfree-ipn',
        'product-payfast-ipn',

        'event-paytm-ipn',
        'event-razorpay-ipn',
        'event-paystack-ipn',
        'event-flullterwave-ipn',
        'event-payfast-ipn',
        'event-cashfree-ipn',

        'gig-paytm-ipn',
        'gig-razorpay-ipn',
        'gig-paystack-ipn',
        'gig-flullterwave-ipn',
        'gig-payfast-ipn',
        'gig-cashfree-ipn',

    ];
}
