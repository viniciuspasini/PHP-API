<?php

require_once '../vendor/autoload.php';

use Vinip\Api\Core\Core;
use Vinip\Api\Http\Route;

Core::dispatch(Route::routes());
