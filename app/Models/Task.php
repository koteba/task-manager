<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
	public $timestamps = true;
	protected $fillable = [
        'id',
        'name',
		'notes',
		'start_date',
		'end_date',
		'description',
		'status_id',
		'project_id',
        'is_active',
    ];

	


    public function project()
	{
		return $this->belongsTo(Project::class);
	}



	public function taskassignment()
{
    return $this->hasMany(TaskAssignment::class);
}

public function users()
{
	return $this->belongsToMany(User::class);
}
}
