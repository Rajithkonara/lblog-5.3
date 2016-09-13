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
</div>

