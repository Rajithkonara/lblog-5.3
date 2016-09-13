<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $fillable = [
		'name'
	];

	/**
	 * get the articles belongto given tag
	 * @return [type] [description]
	 */
	public function articles()
	{
		return $this->belongsToMany('App\Article');
	}
}
