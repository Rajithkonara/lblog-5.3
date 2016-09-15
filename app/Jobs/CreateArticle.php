<?php

namespace App\Jobs;

use App\Article;
use App\Http\Requests\ArticlesRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CreateArticle implements ShouldQueue
{
    protected $article;

    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        //
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ArticlesRequest $request)
    {

       // $articles = $this->article->get();

       $article = Auth::user()->articles()->create($request->all());
       $article->tags()->attach($request->input('tags'));

       // Auth::user()->notify(new ArticlePublished($article));
        // dd($article);
    }
}
