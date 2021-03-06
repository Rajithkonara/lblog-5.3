@include('partials.header')


<div class="blog-post">
    <h2 class="blog-post-title">{{ $article->title }}</h2>
    <hr>
    <p class="blog-post-meta">{{ $article->created_at }}</p>
    <p>{{ $article->body }}</p>
    @unless ($article->tags->isEmpty())
        <h2>Tags : </h2>
        <ul>
            @foreach($article->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless
    @can('update',$article)
        <a href="{{  url('articles/edit',$article->id)}} ">Edit</a>
    @endcan

    <hr>
    <ul>
        @foreach($article->adjustments as $user)
            <li>{{ $user->email }} on {{ $user->pivot->updated_at->diffForHumans() }}</li>
            {{-- <li>did changed {{ $user->pivot }}</li> --}}
        @endforeach
    </ul>


</div>

