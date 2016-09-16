<?php

namespace App\Http\Controllers;

use App\Article;
use App\Events\ArticleCreated;
use App\Http\Requests;
use App\Http\Requests\ArticlesRequest;
use App\Http\Requests\CreatePostRequest;
use App\Jobs\CreateArticle;
use App\Notifications\ArticlePublished;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->middleware('auth', ['only' => 'create']);
    }
    /**
     * Load main page
     * @return view articles.index
     */
    public function index()
    {
        $articles = $this->article->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $tags = Tag::all('id', 'name');
        return view('articles.create', compact('tags'));
    }

    /**
     * @param ArticlesRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticlesRequest $request)
    {
        //dd($request->all());
        $this->dispatch(new CreateArticle($request));
        return redirect('/');
    }

}
