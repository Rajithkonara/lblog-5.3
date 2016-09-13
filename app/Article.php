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

	/**
	 * tages belong to many articles
	 * @return [type] [description]
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}
}
