<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    const validation = [
        'name' => 'required|max:50|unique:types,name',
        'sort' => 'nullable|integer'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $types = Type::cursor()->each(function ($type) {
        //     $type->animals();
        // });
        $types = Type::find(1);
        $types->animals();
        return response($types, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this::validation);
        if ($validator->fails()) {
            return $validator->errors();
        }

        if (empty($request->sort)) {
            $max = Type::get()->max('sort') ?: 100;
            $request->sort = $max + 1;
        }

        $type = Type::create($request->all());
        return response($type, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return response($type, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        if ($request->method() === 'PUT') {
            $validator = Validator::make($request->all(), $this::validation);
            if ($validator->fails()) return $validator->errors();
        }

        $type->update($request->all());
        return response($type, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return response($type, Response::HTTP_NO_CONTENT);
    }
}
