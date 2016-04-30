@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}" style="color: #547477"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Back to teaching units</a>
    <h2>
        {{ $teachingUnit->name }}
    </h2>
@stop
    @section('content')

    <div class="panel panel-default">
      <div class="panel-body">
            <h3>{{ $teachingUnit->title }}</h3>
            <div class="text-justify"><h4>Summary of content: {!! $teachingUnit->description !!}</h4></div>
            <div><h4>Duration: {{ $teachingUnit->duration }} minutes</h4></div>
            <div><h4>Number of questions:{{ $numberOfQuestions }}</h4></div>
            <div class="text-center">
              <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}" class="app-nav-btn"><div class='btn-raised btn-info center bottom-margin'>Start &nbsp <span class="glyphicon glyphicon-play"></span></div></a>
            </div>
      </div>
    </div>

@stop
