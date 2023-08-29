<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepo\ITaskRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @var ITaskRepo
     */
    private $taskRepo;

    public function __construct(ITaskRepo $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function index(Request $request): JsonResponse
    {
        $tasks = $this->taskRepo->fetch($request->status, $request->categoryId, $request->search);
        return response()->json($tasks, 200);
    }

    public function create(TaskRequest $request): JsonResponse
    {
        $task = $this->taskRepo->save($request->all());
        return response()->json($task, 201);
    }

    public function destroy($id): JsonResponse
    {
        $this->taskRepo->destroy($id);
        return response()->json($id, 203);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $task = $this->taskRepo->update($request->all(), $id);
        return response()->json($task, 201);
    }
}
