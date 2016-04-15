@extends('layouts.master')
@section('header')
    <h2>Edit teaching unit</h2>
@stop

@section('content')
    {!! Form::model($teachingUnit, array('url' => '/dashboard/teaching-units/'.$teachingUnit->id, 'method' => 'put')) !!}
    @include('dashboard.partials.forms.teachingUnit')
    {!! Form::close() !!}
@stop