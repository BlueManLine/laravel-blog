@extends('layouts.admin.standard')

@section('content')
<?php if( !empty($comments) ) : ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th style="width:300px;">Email / Nick</th>
            <th>Comment</th>
            <th style="width:150px;">Created at</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $comments as $comment ) : ?>
        <tr>
            <td>#{{$comment->id }}</td>
            <td>
                @if($comment->getAuthor()->isAdmin)<span class="glyphicon glyphicon-tower" style="color:#D2AC00;"></span>@endif
                {{ $comment->getAuthor()->email.'<br />'.$comment->getAuthor()->nick }}</td>
            <td>{{ $comment->body }}</td>
            <td>{{ $comment->created_at }}</td>
            <td>
                <a href="{{ URL::to('admin/comments/delete/'.$comment->id) }}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">Sorry, no comments yet.</div>
<?php endif; ?>
@stop

