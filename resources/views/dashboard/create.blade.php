@extends('layouts.master')
@section('header')
    <h2>{{ $title }}</h2>
@stop

@section('content')
    {!! Form::open(['url' => $url]) !!}
        @include('dashboard.partials.forms.'.$partial)
    {!! Form::close() !!}
@stop