@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to learning material</a>
    <h2>
        {{ $teachingUnit->name }}
    </h2>
@stop
    @section('content')

    <div class="row">
      <div class="container">
        <div class="thumbnail">
          <div class="caption">
            <h3>{{ $teachingUnit->title }}</h3>
            <div class="text-justify"><h4>Summary of content: {!! $teachingUnit->description !!}</h4></div>
            <div><h4>Duration: {{ $teachingUnit->duration }} minutes</h4></div>
            <div><h4>Number of questions:</h4></div>
            <p> <div class="text-center"><a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}" class="btn btn-primary" role="button">Start</a>
          </div>
        </div>
      </div>
    </div>

@stop
