@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to teaching unitss</a>
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
        <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}">Start</a>
    </div>
@stop