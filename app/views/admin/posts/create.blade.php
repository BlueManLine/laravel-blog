@extends('layouts.admin.standard')

@section('content')
    @include('admin/posts/form_post', ['post' => null])
@stop

@section('js_foot')
<script src="/js-libraries/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post');
</script>
@stop
