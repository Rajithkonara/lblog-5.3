@include('partials.header')
<h1>Edit Article</h1>
<hr/>

<form action="{{ url('articles/edit/') }}/{{ $article->id }}" method="post">
    <div class="content-area">
    <div class="form-group">
        <label for="title">Title</label><br>
        <input type="text" class="form-control" name="title" value="{{ $article->title }}" >
        <br>
        <textarea class="form-control" rows="3" name="body">{{ $article->body }}
        </textarea><br>
        <div class="form-group">
        <select class="form-control" name="tag_list[]" multiple="multiple" id="tag_list">
            @foreach($article->tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Edit</button>
    <input type="hidden" name="_token" value="{{Session::token()}}">
    </div>
</form>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@include('partials.footer')

<script>
    $('#tag_list').select2({
        tags: true
    });
</script>

