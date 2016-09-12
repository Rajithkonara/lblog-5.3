<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
    	$articles = Article::all();
    	return view('articles.index',compact('articles'));
    }
}
