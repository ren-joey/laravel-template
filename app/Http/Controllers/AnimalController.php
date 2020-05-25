<?php

namespace App\Http\Controllers;

use App\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    const validation = [
        'type_id' => 'required',
        'name' => 'required|max:20',
        'birthday' => 'required|date',
        'area' => 'required|max:255',
        'fix' => 'required|boolean',
        'description' => 'nullable',
        'personality' => 'nullable'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        } else {
            // Animal Model 有 create 寫好的方法，把請求的內容，用all方法轉為陣列，傳入 create 方法中。
            $animal = Animal::create($request->all());

            // 回傳 animal 產生出來的實體物件資料，第二個參數設定狀態碼，可以直接寫 201 表示創建成功的狀態螞或用下面 Response 功能
            return response($animal, Response::HTTP_CREATED);
            // return response()->json($animal);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $method = $request->method();
        if ($method === 'PATCH') {
            $animal->update($request->all());
        } else if ($method === 'PUT') {
            // $validator =
        }

        return response($animal, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response($animal, Response::HTTP_NO_CONTENT);
    }
}
