<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

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
            'query' => $request->query('query') ?: $request->old('query')
        ], Response::HTTP_OK);
    }

    public function boolean(Request $request)
    {
        $archived = $request->boolean('isDev');
        return response([
            'dev' => $archived
        ], Response::HTTP_OK);
    }

    public function flash(Request $request)
    {
        if ($request->has('query')) {
            if ($request->boolean('cache')) {
                $request->flashOnly('query');
            }

            return response([
                'oldInput' => $request->old('query') ?: $request->query('query')
            ], Response::HTTP_OK);
        }
    }

    public function redirect(Request $request)
    {
        $request->flash();
        return redirect('query')->withInput();
    }

    public function cookie(Request $request)
    {
        Cookie::queue('my-cookie', $request->input('my-cookie'), 9999);
        return response(Cookie::get('my-cookie'), Response::HTTP_OK);
    }

    public function bag(Request $request)
    {
        // $validatedData = $request->validateWithBag('post', [
        //     'id' => ['required'],
        //     'name' => ['required']
        // ]);
    }
}
