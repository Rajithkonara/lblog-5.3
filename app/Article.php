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
     * Listen to update event and hit db record
     * @return [type] [description]
     */
    public static function boot()
    {
        parent::boot();
        static::updating(function($article){
            $article->adjust();
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
        ->withPivot(['before', 'after'])  //tell elequont
        ->latest('pivot_updated_at');
    }

    public function adjust($userId = null, $diff = null)
    {
        $userId = $userId ?: Auth::user()->id;
        $diff = $diff ?: $this->getDiff();

        return $this->adjustments()->attach($userId,$diff);
    }

    protected function getDiff()
    {
        $changed = $this->getDirty();

        $before = json_encode(array_intersect_key($this->fresh()->toArray(),$changed));
        $after  = json_encode($changed);

        return compact('before','after');
    }

}
