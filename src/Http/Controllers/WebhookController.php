<?php

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\PaystackLaravel\Events\{WebhookReceived, WebhookHandled};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $middleware = config('paystack.middleware');

        $this->middleware($middleware['webhook.handle'] ?? ['web']);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request)
    {
        // 
        dump($request->all());

        // WebhookReceived::dispatch($payload);

        return new Response('Webhook Handled', 200);
    }
}
