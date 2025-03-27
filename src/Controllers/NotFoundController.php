<?php

namespace Vinip\Api\Controllers;

use Vinip\Api\Http\Request;
use Vinip\Api\Http\Response;

class NotFoundController
{
    public function index(Request $request, Response $response)
    {
        $response::json([
            'error' => true,
            'success' => false,
            'message' => 'route not exist'
        ], 404);

        return;
    }
}