<?php

namespace App\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class InitController extends Controller
{
    use Helpers;

    const PAGESIZE = 20;
}