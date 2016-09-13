<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticlesRequest;
use App\Notifications\ArticlePublished;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => 'create']);
    }
	/**
	 * Load main page
	 * @return view articles.index
	 */
    public function index()
    {
    	$articles = Article::latest()->get();
    	return view('articles.index',compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }

    public function create()
    {
       $tags = Tag::all('id', 'name');
       return view('articles.create',compact('tags'));
   }

   public function store(ArticlesRequest $request)
   {
       $article = Auth::user()->articles()->create($request->all());
       $article->tags()->attach($request->input('tags'));
       Auth::user()->notify(new ArticlePublished($article));
       return redirect('/');
   }

}
