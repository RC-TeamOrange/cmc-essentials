@extends('layouts.master')
@section('header')
    <h2>Add a new teaching unit</h2>
@stop

@section('content')
    {!! Form::open(['url' => '/dashboard/teaching-units/'.$teachingUnit->id.'/study-materials']) !!}
        @include('dashboard.partials.forms.studyMaterial')
    {!! Form::close() !!}
@stop