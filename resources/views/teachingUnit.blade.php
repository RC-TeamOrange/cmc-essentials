@extends('layouts.master')
@section('header')
    <a href="{{ url('/teaching-units') }}">Back to teaching units</a>
    <h2>
        {{ $teachingUnit->name }}
    </h2>
@stop
    @section('content')

    <div class="row">
      <div class="container">
        <div class="thumbnail">
          <img src="/var/www/laravel/resources/icons/education.png">
          <div class="caption">
            <h3>{{ $teachingUnit->title }}</h3>
            <div>Summary of content: {{ $teachingUnit->description }}</div>
            <div>Duration: {{ $teachingUnit->duration }} minutes</div>
            <div>Number of questions:</div>
            <p> <div class="text-center"><a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}" class="btn btn-primary" role="button">Start</a>
          </div>
        </div>
      </div>
    </div>

@stop
