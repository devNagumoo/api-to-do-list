<?php

namespace App\Service;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskService
{

    public function createTask($data)
    {
        try {
           $validador =  Validator::make($data, [
                'tarefa' => 'required|string',
                'data_vencimento' => 'required|date',
            ], [
                'tarefa.required' => 'A tarefa é obrigatoria',
                'data_vencimento.required' => 'Data de vencimento é obrigatoria',
            ]);

            if($validador->fails()){
                return ['success' => false, 'errors' => $validador->errors()]; 
            }

            $user = auth()->user();
            $validated = $validador->validated();
            $newTask = $user->task()->create($validated);
            return $newTask;
        } catch (ValidationException $e) {
            return ['errors' => $e->errors()];
        }
    }

    public function updateTask($data, $idTask)
    {
        try {
            Validator::validate($data, [
                'tarefa' => 'required|string',
                'data_vencimento' => 'required|date'
            ], [
                'tarefa.required' => 'A tarefa é obrigatoria',
                'data_vencimento.required' => 'Data de vencimento é obrigatoria'
            ]);

            $task = Task::find($idTask);
            $task->update($data);

            return $task;
        } catch (ValidationException $e) {
            return ['erros' => $e->errors()];
        }
    }
}
