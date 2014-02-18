@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">

        {{ Form::open() }}

            <div class="form-group">
                {{ Form::label('email', 'Email address') }}
                {{ Form::email('email', null, array('class'=>'form-control','placeholder'=>'Enter email')) }}
                {{ $errors->first('email') }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Your password') }}
                {{ Form::password('password', array('class'=>'form-control','placeholder'=>'Your password')) }}
                {{ $errors->first('password') }}
            </div>

            {{ Form::submit('Log me in', array('class'=>'btn btn-primary')) }}

        {{ Form::close() }}

        <br />
        <p style="display:none;">
            {{ link_to('user/remind','Remind a password') }}
        </p>

    </div>
</div>
@stop