@include('partials.header')
<div class="container">

  <div class="blog-header">
    <h1 class="blog-title">The RK Blog</h1>
    <p>Page Visits {{ $visits }}</p>
  </div>
  <div class="row">
    <div class="col-sm-8 blog-main">
      @foreach($articles as $article)
      <div class="blog-post">
        <h2 class="blog-post-title"><a name="show" href="{{url('/articles',$article->id)}}">{{ $article->title }}</a></h2><br>
        <p class="blog-post-meta">{{ $article->created_at }}</p>
        <p>{{ $article->body }}</p>
        <hr>

      </div><!-- /.blog-post -->
      @endforeach
      <nav>
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </nav>

    </div><!-- /.blog-main -->

    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
      <div class="sidebar-module sidebar-module-inset">
        <h4>Slot</h4>
        <p></p>
      </div>
      <div class="sidebar-module">
        <h4>slot</h4>
        <ol class="list-unstyled">
          <li><a href="#"></a></li>
        </ol>
      </div>
      <div class="sidebar-module">
        <h4>Social</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</div><!-- /.container -->
@include('partials.footer')
