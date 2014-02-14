@extends('layouts.admin.standard')

@section('content')
<form method="post" role="form">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter post title">
    </div>

    <div class="form-group">
        <label for="editor">Post text</label>
        <textarea id="editor" cols="10" rows="10" class="form-control" placeholder="Put here your minds ;)"></textarea>
    </div>

    <div class="form-group">
        <label for="title">Tags</label>
        <input type="text" class="form-control" id="title" placeholder="Tags">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>
@stop

@section('js_foot')
<script src="/js-libraries/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor');
</script>
@stop
