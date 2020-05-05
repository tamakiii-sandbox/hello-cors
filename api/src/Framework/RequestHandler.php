<?php

namespace App\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RequestHandler
{
    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function handle(Request $request, RequestContext $context)
    {
        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $parameters = $matcher->match($_SERVER['REQUEST_URI'] ?? '');
            return $this->call_matched_parameters($parameters, $request);
        } catch (ResourceNotFoundException $e) {
            try {
                $parameters = $matcher->match('/404');
                return $this->call_matched_parameters($parameters, $request);
            } catch (ResourceNotFoundException $e) {
                header("Content-type: text/plain");
                header("HTTP/1.0 404 Not Found");
                echo '404 Not found' . PHP_EOL;
            }
        } catch (\Exception $e) {
            try {
                $parameters = $matcher->match('/500');
                return $this->call_matched_parameters($parameters, $request);
            } catch (ResourceNotFoundException $e) {
                header("Content-type: text/plain");
                header("HTTP/1.0 500 Internal Server Error");
                echo '500 Internal Server Error' . PHP_EOL;
            }
        }
    }

    private function call_matched_parameters($parameters, Request $request): Response
    {
        if (empty($parameters['_controller'])) {
            throw new \UnexpectedValueException('_controller must be set');
        }

        if (!is_callable($parameters['_controller'])) {
            throw new \UnexpectedValueException('_controller must be callable');
        }

        $response = call_user_func_array($parameters['_controller'], [$request]);

        if (!$response instanceof Response) {
            throw new \UnexpectedValueException('_controller must return an instance of HTTP-Response');
        }

        return $response;
    }
}