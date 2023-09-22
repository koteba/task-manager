<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;

    public $timestamps = true;
	protected $fillable = [
        'id',
		'task_id',
		'user_id',
     
    ];


    public function task()
	{
		return $this->belongsTo('App\Models\Task', 'task_id');
	}

    public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}

