@extends('layouts.master')

@section('content')
<?php if( !is_null($record) && ($record->status==1 || ( $record->status==0 && Auth::admin()->check() ) ) ) : ?>
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $record->title }}</h2>
        <p class="blog-post-meta">{{ $record->created_at }} by {{ $record->admin->nick }}</p>

        <p>{{ $record->post }}</p>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3>Comments</h3>
            <?php if( $record->comments->count()>0 ) : ?>
                <?php foreach($record->comments()->get() as $comment) : ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="blog-post-meta">
                                {{ $comment->created_at }}
                                by @if($comment->getAuthor()->isAdmin)<span class="glyphicon glyphicon-tower" style="color:#D2AC00;"></span>@endif {{ $comment->getAuthor()->nick }}
                            </p>
                            <blockquote>{{ $comment->body }}</blockquote>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <span class="alert alert-success">No comments yet</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <?php if( Auth::user()->check() || Auth::admin()->check() ) : ?>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <?php echo Form::label('text', 'Your comment'); ?>
                        <?php echo Form::textarea('text', null, array('class' => 'form-control', 'rows'=>5, 'cols'=>10)); ?>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            <?php else : ?>
                <span class="alert alert-success">You must be logined to add a comments</span>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
    <span class="alert alert-danger">Sorry, the post doesnt exists.</span>
<?php endif; ?>
@stop