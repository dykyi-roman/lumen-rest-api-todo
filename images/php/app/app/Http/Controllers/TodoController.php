<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\todo\Domain\Todo\TodoApiTransformer;
use App\todo\Domain\Todo\Service\TodoManager;
use App\todo\Domain\Todo\TodoMapper;
use Faker\Provider\Uuid;
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
        $todo = TodoManager::init((string)$this->auth::id())->filterBy($request->all());
        $data = TodoMapper::init()->map($todo);

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $uuid = Uuid::uuid();
            TodoManager::init((string)$this->auth::id())->create($uuid, $request->toArray());

            return response()->json(['status' => 'success', 'uuid' => $uuid], 201);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function show(string $uuid): JsonResponse
    {
        try {
            $todo = TodoManager::init((string)$this->auth::id())->show($uuid);
            $transformer = new TodoApiTransformer($todo);

            return response()->json(['status' => 'success', 'data' => $transformer->transform()]);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 404);
        }
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        try {
            TodoManager::init((string)$this->auth::id())->update($uuid, $request->toArray());

            return response()->json(['status' => 'success']);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    public function delete(string $uuid): JsonResponse
    {
        try {
            TodoManager::init((string)$this->auth::id())->delete(['uuid' => $uuid]);
        } catch (Throwable $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

        return response()->json(['status' => 'success']);
    }
}
