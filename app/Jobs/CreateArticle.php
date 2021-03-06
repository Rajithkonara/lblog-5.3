<?php declare(strict_types = 1);

namespace App\Jobs;

use App\Article;
use App\Events\ArticleCreated;
use App\Http\Requests\ArticlesRequest;
use App\Notifications\ArticlePublished;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class CreateArticle implements ShouldQueue
{

    /** @var CreatePostRequest */
    private $request;

    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @param array $requestData
     * @internal param ArticlesRequest $request
     */
    public function __construct(array $requestData)
    {
        $this->request = $requestData;
    }

    /**
     * Execute the job.
     * @internal param ArticlesRequest $request
     */
    public function handle()
    {
        /** @var Article $article */
        $article = $this->createArticle();

        if ($article) {
            $article->tags()->attach(request('tags'));
//            $this->notifyAuthor($article);
//            event(new ArticleCreated($article));
        }
    }

    private function createArticle(): Article
    {
        return Auth::user()->articles()->create($this->request);
    }

    private function notifyAuthor(Article $article)
    {
        Auth::user()->notify(new ArticlePublished($article));
    }
}
