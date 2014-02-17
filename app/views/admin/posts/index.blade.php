@extends('layouts.admin.standard')

@section('content')
<?php if( !empty($posts) ) : ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Title</th>
            <th>First 100 chars</th>
            <th>Options</th>
            <th>Added at</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $posts as $post ) : ?>
        <tr>
            <td>#<?php echo $post->id; ?></td>
            <td>
                <?php
                    $icon = $post->status==1 ? 'ok' : 'remove';
                    $color = $post->status==1 ? 'green' : 'red';
                ?>
                <span class="glyphicon glyphicon-{{ $icon }}" style="color:{{ $color }};"></span>
            </td>
            <td><?php echo $post->title; ?></td>
            <td><?php echo mb_substr($post->post,0,100); ?></td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="{{ URL::to('admin/posts/edit/'.$post->id) }}" class="btn btn-success">Edit</a>
                    <a href="{{ URL::to('admin/posts/visibility/'.$post->id) }}" class="btn btn-default"><?php echo $post->status==1 ? 'Hide it' : 'Make visible'; ?></a>
                </div>
            </td>
            <td><?php echo $post->created_at; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">Sorry, no post yet.</div>
<?php endif; ?>
@stop

