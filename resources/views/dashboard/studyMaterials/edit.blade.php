@extends('layouts.master')
@section('header')
    <h2>Edit Study Material</h2>
@stop

@section('content')
    {!! Form::model($studyMaterial, array('url' => '/dashboard/teaching-units/'.$teachingUnit->id.'/study-materials/'.$studyMaterial->id, 'method' => 'put')) !!}
        @include('dashboard.partials.forms.studyMaterial')
    {!! Form::close() !!}
@stop