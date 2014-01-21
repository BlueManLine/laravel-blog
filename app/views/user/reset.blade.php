@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">

        <?php echo Form::open(); ?>

            <?php echo Form::hidden('token', $token); ?>

            <div class="form-group">
                <?php echo Form::label('email', 'Email address'); ?>
                <?php echo Form::email('email', null, array('class'=>'form-control','placeholder'=>'Enter email')); ?>
                <?php echo $errors->first('email'); ?>
            </div>

            <div class="form-group">
                <?php echo Form::label('password', 'New password'); ?>
                <?php echo Form::password('password', array('class'=>'form-control','placeholder'=>'Enter new password')); ?>
                <?php echo $errors->first('password'); ?>
            </div>

            <div class="form-group">
                <?php echo Form::label('password_confirmation', 'Retype new password'); ?>
                <?php echo Form::password('password_confirmation', array('class'=>'form-control','placeholder'=>'Enter new password')); ?>
                <?php echo $errors->first('password_confirmation'); ?>
            </div>

            <?php echo Form::submit('Reset password', array('class'=>'btn btn-primary')); ?>

        <?php echo Form::close(); ?>

    </div>
</div>
@stop