@extends('layouts.master')

@section('content')
<hr />
<div class="blog-post">
    <?php if( !is_null($record) && ($record->status==1 || ( $record->status==0 && Auth::admin()->check() ) ) ) : ?>
        <h2 class="blog-post-title">{{ $record->title }}</h2>
        <p class="blog-post-meta">{{ $record->created_at }} by {{ $record->admin->nick }}</p>

        <p>{{ $record->post }}</p>
    <?php else : ?>
        <span class="alert alert-danger">Sorry, the post doesnt exists.</span>
    <?php endif; ?>
</div>
@stop