<?php declare(strict_types = 1);

namespace App\Jobs;

use App\Article;
use App\Events\ArticleCreated;
use App\Http\Requests\CreatePostRequest;
use App\Notifications\ArticlePublished;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\ApacheRequest;

class CreateArticle implements ShouldQueue
{
    /** @var CreatePostRequest */
    private $request;

    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @param ApacheRequest $request
     */
    public function __construct(ApacheRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        /** @var Article $article */
        $article = $this->createArticle();

        if ($article) {
            $article->tags()->attach($this->request->input('tags'));
            $this->notifyAuthor($article);
            event(new ArticleCreated($article));
        }
    }

    private function createArticle(): Article
    {
        return Auth::user()->articles()->create($this->request->all());
    }

    private function notifyAuthor(Article $article)
    {
        Auth::user()->notify(new ArticlePublished($article));
    }
}
