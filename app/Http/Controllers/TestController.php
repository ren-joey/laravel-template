<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response(
            [
                'name' => $request->name,
                'invoke' => true
            ], Response::HTTP_OK
        );
    }

    public function get(Request $request)
    {
        return response([
            'name' => $request->name
        ], Response::HTTP_OK);
    }

    public function query(Request $request)
    {
        return response([
            'query' => $request->query('query')
        ], Response::HTTP_OK);
    }
}
