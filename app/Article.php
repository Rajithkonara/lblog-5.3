<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    /**
     * Listen to update event
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();

        static::updating(function($article){
        $article->adjustments()->attach(Auth::user()->id);
        });
    }


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

    public function adjustments()
    {
        return $this->belongsToMany('App\User','adjustments')
        ->withTimestamps()
        ->latest();
    }


}
