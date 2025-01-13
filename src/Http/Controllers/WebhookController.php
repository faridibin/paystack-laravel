<?php

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\PaystackLaravel\Http\Middleware\ValidateWebhookSignature;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware(ValidateWebhookSignature::class);
    }

    public function handle(Request $request)
    {
        // 
    }
}
