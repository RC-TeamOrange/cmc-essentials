@extends('layouts.master')
@section('header')
    <h2>Add a new teaching unit</h2>
@stop

@section('content')
    {!! Form::open(['url' => '/dashboard/teaching-units']) !!}
        @include('dashboard.partials.forms.teachingUnit')
    {!! Form::close() !!}
@stop