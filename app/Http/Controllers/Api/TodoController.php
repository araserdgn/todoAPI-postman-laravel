<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Services\TodoService;
use Illuminate\Http\Request;

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

    public function edit($id,Request $request) {
        return $this->todoService->find($id);
        return "TODO tek veri";
    }
}
