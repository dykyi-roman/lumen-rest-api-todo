<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\todo\Domain\Todo\TodoApiTransformer;
use App\todo\Domain\Todo\Service\TodoManager;
use App\todo\Domain\Todo\TodoMapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TodoController extends Controller
{
    private Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
        $this->middleware('cors');
    }

    public function index(Request $request): JsonResponse
    {
        $todo = TodoManager::init($this->auth::id())->filterBy($request->all());
        $data = TodoMapper::init()->map($todo);

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            TodoManager::init($this->auth::id())->create($request->toArray());

            return response()->json(['status' => 'success'], 201);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $todo = TodoManager::init($this->auth::id())->show($id);
            $transformer = new TodoApiTransformer($todo);

            return response()->json(['status' => 'success', 'data' => $transformer->transform()]);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 404);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            TodoManager::init($this->auth::id())->update($id, $request->toArray());

            return response()->json(['status' => 'success']);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            TodoManager::init($this->auth::id())->delete(['id' => $id]);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

        return response()->json(['status' => 'success']);
    }
}
