<?php
namespace App\Repositories;

use App\Article;
use App\Http\Requests\ArticlesRequest;
use App\Notifications\ArticlePublished;
use Illuminate\Support\Facades\Auth;

class ArticleRepository
{

	protected $article;

	public function __construct(Article $article)
	{
		$this->article = $article;
	}

	public function get()
	{
        return $this->article->latest()->get();
	}

	public function saveArticle(ArticlesRequest $request)
	{
	   return $this->article->create($request);
	}

}