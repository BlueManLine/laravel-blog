@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">

        {{ Form::open() }}

        <div class="form-group">
            {{ Form::label('nick', 'Your nick') }}
            {{ Form::text('nick', Auth::user()->user()->nick, array('class'=>'form-control','placeholder'=>'Your nickname')) }}
            {{ $errors->first('nick') }}
        </div>

        {{ Form::submit('Change', array('class'=>'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

    <div class="col-6 col-sm-6 col-lg-5">

    <dl class="dl-horizontal">
        <dt>Your email</dt>
        <dd>{{ Auth::user()->user()->email }}</dd>

        <dt>Last update</dt>
        <dd>{{ Auth::user()->user()->updated_at }}</dd>

        <dt>Created at</dt>
        <dd>{{ Auth::user()->user()->created_at }}</dd>
    </dl>

        </div>
</div>
@stop