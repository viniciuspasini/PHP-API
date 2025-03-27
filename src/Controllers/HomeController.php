<?php

namespace Vinip\Api\Controllers;
use Vinip\Api\Http\Request;
use Vinip\Api\Http\Response;

class HomeController
{
    public function index(Request $request, Response $response, $matches)
    {
        $response::json([
            'error' => false,
            'success' => true,
            'message' => 'Home'
        ], 200);

        return;
    }
}