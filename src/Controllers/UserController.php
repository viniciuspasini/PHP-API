<?php

namespace Vinip\Api\Controllers;

use Vinip\Api\Http\Request;
use Vinip\Api\Http\Response;
use Vinip\Api\Services\UserService;

class UserController
{
    public function store(Request $request, Response $response): void
    {
        $body = Request::body();

        $userService = UserService::create($body);

        $status = isset($userService['error']) ? 400 : 200;

        Response::json([
            'error' => isset($userService['error']),
            'success' => !isset($userService['error']),
            'message' => $userService['error'] ?? $userService
        ], $status);

    }

    public function login(Request $request, Response $response): void
    {
        $body = Request::body();

        $userService = UserService::login($body);

        $status = isset($userService['error']) ? 400 : 200;

        Response::json([
            'error' => isset($userService['error']),
            'success' => !isset($userService['error']),
            'token' => $userService['error'] ?? $userService
        ], $status);
    }

    public function fetch(Request $request, Response $response): void
    {

        $body = Request::body();

        $userService = UserService::fetch($body['id'], Request::authorization());

        $status = isset($userService['error']) ? 400 : 200;

        Response::json([
            'error' => isset($userService['error']),
            'success' => !isset($userService['error']),
            'user' => $userService['error'] ?? $userService
        ], $status);
    }

    public function update(Request $request, Response $response)
    {

    }

    public function remove(Request $request, Response $response, array $id)
    {

    }
}