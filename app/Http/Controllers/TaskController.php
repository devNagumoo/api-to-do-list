<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Service\TaskService;
use App\Traits\Traits;
use Exception;
use Illuminate\Http\ResponseTrait;

class TaskController extends Controller
{

    use Traits;

    private $service;

    public function __construct(TaskService $task)
    {
        $this->service = $task;
    }

    public function index()
    {
        $tasks = Task::all();

        return TaskResource::collection($tasks);
    }

    public function show($idTask)
    {
        $task = Task::find($idTask);

        if (!$task) {
            return $this->messageResponse('A tarefa não foi encontrada', 404);
        }

        return new TaskResource($task);
    }

    public function store(Request $request)
    {
        $newTask = $this->service->createTask($request->all());

        if (is_array($newTask)) {
            return response()->json($newTask, 400);
        }

        return new TaskResource($newTask);
        
    }

    public function update(Request $request, $idTask)
    {
        $updateTask = $this->service->updateTask($request->all(), $idTask);

        if (is_array($updateTask)) {
            return response()->json($updateTask);
        }

        return new TaskResource($updateTask);
    }

    public function delete($idTask) {}
}
