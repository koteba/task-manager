<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
	public $timestamps = true;
	protected $fillable = [
        'id',
        'name',
		'notes',
    ];


    public function projects()
	{
		return $this->hasOne(Project::class);
	}
}
