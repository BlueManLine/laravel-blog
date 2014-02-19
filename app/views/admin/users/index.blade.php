@extends('layouts.admin.standard')

@section('content')
<?php if( !empty($users) ) : ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Status</th>
            <th>Email / Nick</th>
            <th>Options</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $users as $user ) : ?>
        <tr>
            <td>#<?php echo $user->id; ?></td>
            <td>
                <?php
                    $icon = $user->status==1 ? 'ok' : 'remove';
                    $color = $user->status==1 ? 'green' : 'red';
                ?>
                <span class="glyphicon glyphicon-{{ $icon }}" style="color:{{ $color }};"></span>
            </td>
            <td>{{ $user->email.'<br/>'.$user->nick }}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="{{ URL::to('admin/users/edit/'.$user->id) }}" class="btn btn-success">Edit</a>
                    <a href="{{ URL::to('admin/users/status/'.$user->id) }}" class="btn btn-default"><?php echo $user->status==1 ? 'Unactive it' : 'Active it'; ?></a>
                </div>
            </td>
            <td><?php echo $user->created_at; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">Sorry, no users yet.</div>
<?php endif; ?>
@stop

