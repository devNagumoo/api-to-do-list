<?php

namespace App\Service;

use App\Models\Task;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskService
{

    use ApiResponse;

    public function createTask($data)
    {
        $user = auth()->user();

        $task = $user->task()->create([
            'tarefa' => $data['tarefa'],
            'data_vencimento' => $data['data_vencimento']
        ]);

        return $task;
    }

    public function updateTask($data, $idTask)
    {
        $task = Task::find($idTask);
        $user = auth()->user();

        if ($user->id != $task->user_id) {
            throw new Exception('Você não tem permissão para editar este recurso', 401);
        }

        $task->update([
            'tarefa' => $data['tarefa'],
            'data_vencimento' => $data['data_vencimento']
        ]);

        return $task->refresh();

        
    }
}
