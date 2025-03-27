<?php

namespace Vinip\Api\Http;

class Request
{
    public static function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input') , true) ?? [];
        return match(self::method()){
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json
        };
    }

    public static function authorization(): string|array
    {
        $authorization = getallheaders();

        if (!isset($authorization['Authorization'])) return ['error' => 'Unauthorized'];

        $authorizationParts = explode(' ', $authorization['Authorization']);

        if (count($authorizationParts) != 2) return ['error' => 'ivalid authorization header'];

        return $authorizationParts[1] ?? '';
    }
}