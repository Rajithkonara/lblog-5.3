<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlesRequest;
use App\Jobs\CreateArticle;
use App\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;

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
        //site visits
        $visits = Redis::incr('visits');
        $articles = $this->article->latest()->get();
        return view('articles.index', compact('articles'))->
        withVisits($visits);
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

    public function edit(Article $article)
    {
        if (Gate::denies('update', $article)) {
            abort(403, 'Sorry cannot you cannot edit');
        }
//        $this->authorize('update',$article);
        return view('articles.edit', compact('article'));
    }

    public function delete(Article $article)
    {
        if (Gate::denies('delete', $article)) {
            abort(403, 'You have no permission');
        }

        return view('articles.show', compact('article'));
    }

    /**
     * @param ArticlesRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticlesRequest $request)
    {
        $this->dispatch(new CreateArticle($request->all()));

        return redirect('/');
    }

    /**
     * @param Article $article
     * @param ArticlesRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Article $article, ArticlesRequest $request)
    {
        $article->update($request->all());

        return redirect('/');
    }

    /**
     * Article $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Article $article)
    {
       $article->delete($article);

       return redirect('/');
    }
}
