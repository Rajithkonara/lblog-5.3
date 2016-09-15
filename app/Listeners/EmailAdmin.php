<?php

namespace App\Listeners;

use App\Article;
use App\Events\ArticleCreated;
use App\Notifications\ArticlePublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class EmailAdmin
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        Auth::user()->notify(new ArticlePublished($event->article));
    }
}
