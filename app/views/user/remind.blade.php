@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">

        <?php echo Form::open(); ?>

            <div class="form-group">
                <?php echo Form::label('email', 'Email address'); ?>
                <?php echo Form::email('email', null, array('class'=>'form-control','placeholder'=>'Enter email')); ?>
                <?php echo $errors->first('email'); ?>
            </div>

            <?php echo Form::submit('Send me reminder', array('class'=>'btn btn-primary')); ?>

        <?php echo Form::close(); ?>

    </div>
</div>
@stop