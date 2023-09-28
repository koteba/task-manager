<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    use HasFactory;
	use SoftDeletes;	
	protected $fillable = [
        'id',
		'project_id',
		'user_id',
		'deleted_at',

     
    ];

	protected $dates = ['deleted_at'];



	public function project()
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }




	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
