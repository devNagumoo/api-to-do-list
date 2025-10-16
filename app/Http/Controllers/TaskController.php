<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Service\TaskService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    use ApiResponse;

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
            return $this->message('A tarefa não foi encontrada', 404);
        }

        return new TaskResource($task);
    }

    public function store(Request $request)
    {
        $validador =  Validator::make($request->all(), [
            'tarefa' => 'required|string',
            'data_vencimento' => 'required|date',
        ], [
            'tarefa.required' => 'A tarefa é obrigatoria',
            'data_vencimento.required' => 'Data de vencimento é obrigatoria',
        ]);

        if ($validador->fails()) {
            return $this->errors(
                'Ocorreu erros na validação',
                400,
                $validador->errors()->toArray()
            );
        }

        try {
            $task = $this->service->createTask($request->all());
            return $this->message(
                'Tarefa criada com sucesso.',
                201,
                new TaskResource($task)
            );
        } catch (Exception $e) {
            return $this->errors(
                'Ocorreu erro interno',
                $e->getCode(),
                $e->getMessage()
            );
        }
    }

    public function update(Request $request, $idTask)
    {
        $validador = Validator::make($request->all(), [
            'tarefa' =>  'required|string',
            'data_vencimento' => 'required|date'
        ], [
            'tarefa.required' => 'A tarefa é obrigatoria',
            'data_vencimento.required' => 'A data de vencimento é obrigatoria',
            'data_vencimento.date' => 'O formato de data é invalido'
        ]);

        if ($validador->fails()) {
            return $this->errors(
                'Ocorreram errors na validação0',
                400,
                $validador->errors()->toArray()
            );
        }

        try {
            $updateTask = $this->service->updateTask($request->all(), $idTask);

            return $this->message(
                'A tarefa foi atualizada com sucesso.',
                200,
                new TaskResource($updateTask)
            );
        } catch (Exception $e) {
            return $this->response(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function delete($idTask) {}
}
