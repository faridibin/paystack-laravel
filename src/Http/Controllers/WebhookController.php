<?php

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\PaystackLaravel\Events\{WebhookReceived, WebhookHandled};
use Faridibin\PaystackLaravel\Http\Requests\WebhookRequest;
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
        $middleware = config('paystack.routes.middleware');

        // $this->middleware($middleware['webhook.handle'] ?? ['web']);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Faridibin\PaystackLaravel\Http\Requests\WebhookRequest  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(WebhookRequest $request): Response
    {
        $payload = $request->safe()->all();

        WebhookReceived::dispatch($payload);

        $method = $this->method($request->event);

        if (method_exists($this, $method)) {
            $response = $this->{$method}($request->data);

            WebhookHandled::dispatch($payload);

            return $response;
        }

        return new Response('Webhook Handled', 200);
    }

    /**
     * Get the method to call.
     * @param string $event
     * 
     * @return string
     */
    private function method(string $event): string
    {
        // 
        dd($event);
    }
}
