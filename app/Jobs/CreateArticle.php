<?php declare(strict_types = 1);

namespace App\Jobs;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateArticle implements ShouldQueue
{
<<<<<<< HEAD
=======
    /** @var CreatePostRequest */
    private $request;
>>>>>>> 0e6652f2afd185791d19d1beccc67b561c7b0241

    use InteractsWithQueue, Queueable, SerializesModels;

    protected $article;
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
