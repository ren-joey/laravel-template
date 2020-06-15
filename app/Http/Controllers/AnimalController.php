<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Http\Resources\AnimalResource;
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

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 設定預設值
        $maker = $request->marker ?: 1;
        $limit = $request->limit ?: 10;

        $query = Animal::query();

        // 篩選欄位條件
        if (isset($request->filters)) {
            $filters = explode(',', $request->filters);
            foreach($filters as $filter) {
                list($criteria, $value) = explode(':', $filter);
                $query->where($criteria, 'like', "%{$value}%");
            }
        }

        //排列順序
        if (isset($request->sort)) {
            $sorts = explode(',', $request->sort);
            foreach($sorts as $sort) {
                list($criteria, $value) = explode(':', $sort);
                if ($value === 'asc' || $value === 'desc') {
                    $query->orderBy($criteria, $value);
                }
            }
        } else {
            $query->orderBy('id', 'asc');
        }

        // $animals = Animal::orderBy('id', 'asc')
        //     ->where('id', '>=', $maker)
        //     ->paginate($limit);

        $animals = $query->where('id', '>=', $maker)->with('type')->paginate($limit);

        return response($animals, Response::HTTP_OK);
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
        // Animal Model 有 create 寫好的方法，把請求的內容，用all方法轉為陣列，傳入 create 方法中。
        $animal = Animal::create($request->all());

        // 回傳 animal 產生出來的實體物件資料，第二個參數設定狀態碼，可以直接寫 201 表示創建成功的狀態螞或用下面 Response 功能
        return response($animal, Response::HTTP_CREATED);
        // return response()->json($animal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        return response(new AnimalResource($animal), Response::HTTP_OK);
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
        if ($method === 'PUT') {
            $validator = Validator::make($request->all(), $this::validation);
            if ($validator->fails()) return $validator->errors();
        }

        $animal->update($request->all());
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

    public function test()
    {
        return response('naming route success', Response::HTTP_OK);
    }
}
