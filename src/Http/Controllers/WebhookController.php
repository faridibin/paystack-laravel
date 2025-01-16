<?php

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\Paystack\Enums\WebhookEvent;
use Faridibin\PaystackLaravel\Events\{WebhookReceived, WebhookHandled};
use Faridibin\PaystackLaravel\Http\Controllers\Concerns\HandlesWebhookEvents;
use Faridibin\PaystackLaravel\Http\Requests\WebhookRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    use HandlesWebhookEvents;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $middleware = config('paystack.routes.middleware');

        $this->middleware($middleware['webhook.handle'] ?? ['web']);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Faridibin\PaystackLaravel\Http\Requests\WebhookRequest  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(WebhookRequest $request): Response
    {
        $webhookEvent = WebhookEvent::tryFrom($request->event);

        WebhookReceived::dispatch($webhookEvent, $request->data);

        $method = $this->method($request->event);

        if (method_exists($this, $method)) {
            $response = $this->{$method}($request->data);

            WebhookHandled::dispatch($webhookEvent, $request->data);

            return $response;
        }

        return $this->handleMissingMethod();
    }

    /**
     * Handle successful calls on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function successMethod(array $parameters = []): Response
    {
        return new Response('Webhook Handled', 200);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleMissingMethod(array $parameters = []): Response
    {
        return new Response;
    }

    /**
     * Get the method to call.
     * @param string $event
     * 
     * @return string
     */
    private function method(string $event): string
    {
        $string = Str::of($event)->replace('.', ' ')->ucfirst()->camel();

        return sprintf('on%s', ucfirst($string));
    }
}
