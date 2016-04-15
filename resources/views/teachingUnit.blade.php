@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to teaching units</a>
    <h2>
        {{ $teachingUnit->name }}
    </h2>
@stop
    @section('content')
    <div>Title: {{ $teachingUnit->title }}</div>
    <div>Level: {{ $teachingUnit->level }}</div>
    <div>Duration: {{ $teachingUnit->duration }}</div>
    <div>Description: {!! $teachingUnit->description !!}</div>
    <div>
        {{ link_to('dashboard/teaching-units/'.$teachingUnit->id.'/study-materials', 'Start') }}
    </div>
@stop