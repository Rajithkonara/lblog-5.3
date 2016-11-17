<?php declare(strict_types = 1);

namespace App\Jobs;

use App\Article;
use App\Events\ArticleCreated;
use App\Http\Requests\ArticlesRequest;
use App\Notifications\ArticlePublished;
use App\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

            $tags = request('tags');

            foreach ($tags as $tag) {
               $tag_check = Tag::where('id',$tag)->get()->pluck('id');

               if (!$tag_check->count()) {
                  $newTag = Tag::firstOrCreate(['name' => $tag]);
                  $article->tags()->attach($newTag);
                  continue;
              }
              $tag_info = $tag_check->all();
          }

              $article->tags()->attach($tag_info);
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
