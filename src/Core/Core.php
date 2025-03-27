<?php

namespace Vinip\Api\Core;

use Vinip\Api\Http\Request;
use Vinip\Api\Http\Response;

class Core
{
    public static function dispatch(array $routes){

        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'Vinip\\Api\\Controllers\\';

        $routeFound = false;

        foreach ($routes as $route){
            $pattern = '#^'.preg_replace('/{id}/', '([\w-]+)', $route['path']).'$#';

            if (preg_match($pattern, $url, $matches)){

                array_shift($matches);

                $routeFound = true;

                if ($route['method'] !== Request::method()){
                    Response::json([
                        'error' => true,
                        'success' => false,
                        'message' => 'method not allowed'
                    ], 405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController.$controller;
                $extenController = new $controller();
                $extenController->$action(new Request(), new Response(), $matches);
            }
        }

        if (!$routeFound){
            $controller = $prefixController.'NotFoundController';
            $extenController = new $controller();
            $extenController->index(new Request(), new Response());
        }

    }
}