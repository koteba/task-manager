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

	// protected $casts = [
    //     'status_id' => Status::class,
    // ];


    public function project()
	{
		return $this->belongsTo('App\Models\Project', 'project_id');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category', 'category_id');
	}
// 	public function statuses()
// {
//     return $this->belongsTo(\App\Enums\Status::class, 'status');
// }

    // public function status()
	// {
	// 	return $this->belongsTo('App\Models\Status', 'status_id');
	// }
	public function taskassignment()
{
    return $this->hasMany(TaskAssignment::class);
}

public function users()
{
	return $this->belongsToMany(User::class);
}
}
