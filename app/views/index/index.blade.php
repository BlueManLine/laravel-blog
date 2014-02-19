@extends('layouts.master')

@section('content')
<p class="pull-right visible-xs">
    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
</p>
<?php if( !is_null($posts) && count($posts)>0 ) : ?>

    <div class="jumbotron">
        <h1><a href="{{ URL::to('post/'.$posts[0]->slug) }}"><?php echo $posts[0]->title; ?></a></h1>
        <p><?php echo mb_substr($posts[0]->post, 0, 500); ?></p>
    </div>

    <?php if( count($posts)>1 ) : ?>
    <div class="row">
        <?php for($i=1; $i<count($posts); $i++) : ?>
        <?php $post = $posts[$i]; ?>
        <div class="col-6 col-sm-6 col-lg-4">
            <h2><a href="{{ URL::to('post/'.$post->slug) }}">{{ $post->title }}</a></h2>
            <p><?php echo mb_substr($post->post, 0, 500); ?></p>
        </div>
        <?php endfor; ?>
    </div>

    <?php echo $posts->links(); ?>

    <?php endif; ?>
<?php else : ?>
    <div class="alert alert-success"><strong>Well done!</strong> Now start adding a posts :)</div>
<?php endif; ?>
@stop