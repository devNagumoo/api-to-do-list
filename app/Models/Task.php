<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'tarefa',
        'data_vencimento'
    ];


    public function user(){
        $this->belongsTo(User::class, 'id');
    }

}
