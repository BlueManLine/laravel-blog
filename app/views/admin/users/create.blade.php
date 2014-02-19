@extends('layouts.admin.standard')

@section('content')
    @include('admin/users/form_user', ['user' => null])
@stop
