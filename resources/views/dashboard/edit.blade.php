@extends('layouts.master')
@section('header')
    <h2>{{ $title }}</h2>
@stop

@section('content')
    {!! Form::model($objModel, array('url' => $url, 'method' => 'put')) !!}
    @include('dashboard.partials.forms.'.$partial)
    {!! Form::close() !!}
@stop