<?php

namespace App\Http\Controllers\folderController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function get($name = '')
    {
        return response([
            'name' => $name
        ], Response::HTTP_OK);
    }
}
