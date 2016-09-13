<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticlesRequest;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
	/**
	 * Load main page
	 * @return view articles.index
	 */
    public function index()
    {
    	$articles = Article::latest()->get();
    	return view('articles.index',compact('articles'));
    }

    public function show($id)
    {
	    $article=Article::findOrFail($id);
    	return view('articles.show',compact('article','id'));
    }
    public function create()
    {
    	$tags = Tag::all('id', 'name');
    	return view('articles.create',compact('tags'));
    }
    public function store(ArticlesRequest $request)
    {
    	if (Auth::check()) {
			$article = Auth::user()->articles()->create($request->all());
			$article->tags()->attach($request->input('tags'));
			 // Auth::user()->articles()->save(new Article($request->all())); //taking useid of

    	}
    	return redirect('/');
    	// if (Auth::Check()) {
    	// $article = new Article();
    	// $article->title = $request->get('title');
     //    $article->body = $request->get('body');
     //    $article->user_id = $request->user()->id;
     //    dd($article);
    	// }
    	// return view('auth.login');

    }

}
