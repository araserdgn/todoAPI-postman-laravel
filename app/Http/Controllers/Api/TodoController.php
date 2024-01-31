<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index(Request $request) {
        $todos = TodoResource::collection($this->todoService->getAll());
        return apiResponse(__('Todo'),200, $todos);
    }

    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' =>"required",
        ],[
            'name.required' => "Name alanı boş bırakılmaz.!"
        ]);

        if($validator->fails()) {
            return apiResponse(__('Validator error'),401, ['errors' => $validator->errors()]);
        }

        $todo = $this->todoService->store($data);

        return apiResponse(__('Todo'),200,$todo);
    }


    public function update($id,Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' =>"required",
        ],[
            'name.required' => "Name alanı boş bırakılmaz.!"
        ]);

        if($validator->fails()) {
            return apiResponse(__('Validator error'),401, ['errors' => $validator->errors()]);
        }

        $this->todoService->update($id,$data);
        $todo = $this->todoService->find($id);

        return apiResponse(__('Todo'),200,$todo);
    }



    public function edit($id,Request $request) {
        return $this->todoService->find($id);
        return "TODO tek veri";
    }
}
