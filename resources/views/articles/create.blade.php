@include('partials.header')
<h1>Create a Article</h1>
<hr/>

<form action="{{ url('articles') }}" method="post">
    <div class="content-area">
    <div class="form-group">
        <label for="title">Title</label><br>
        <input type="text" class="form-control" name="title" placeholder="Title"><br>
        <textarea class="form-control" rows="3" placeholder="body" name="body"></textarea><br>
        <select class="form-control" name="tags[]" multiple="multiple" id="tag_list">
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Add a Article</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

