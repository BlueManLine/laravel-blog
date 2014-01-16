@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">

        {{ Form::open() }}

            <div class="form-group">
                {{ Form::label('email', 'Email address') }}
                {{ Form::email('email', null, array('class'=>'form-control','placeholder'=>'Enter email')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Your password') }}
                {{ Form::password('password', array('class'=>'form-control','placeholder'=>'Your password')) }}
            </div>

            {{ Form::submit('Log me in', array('class'=>'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
</div>
@stop