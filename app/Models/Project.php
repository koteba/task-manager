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
		return $this->belongsTo(Category::class);
	}

  
    public function users()
	{
		return $this->belongsToMany(User::class);
	}
}






