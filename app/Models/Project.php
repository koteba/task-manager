<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
	use SoftDeletes;
    protected $table = 'projects';
	public $timestamps = true;
	protected $fillable = [
        'id',
        'name',
        'client',
        'budget',
        'image',
		'notes',
		'start_date',
		'end_date',
		'description',
		'category_id',
		'status_id',
		'deleted_at',
        'is_active',
    ];
	protected $dates = ['deleted_at'];

    public function projectassignment()
    {
        return $this->hasMany(ProjectAssignment::class);
    }

  

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
	public function category()
	{
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

    // public function status()
	// {
	// 	return $this->belongsTo('App\Models\Status', 'status_id');
	// }

    public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}






