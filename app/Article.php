<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = [
		'title',
        'body',
        'user_id'
	];
	/**
	 * [One Article belong to one user]
	 * @return [type] [description]
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
