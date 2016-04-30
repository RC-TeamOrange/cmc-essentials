@extends('layouts.master')
@section('header')
    <a href="{{ url('/syllabus') }}" style="color: #547477"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Back to syllabus</a>
    <h2>
        Teaching units
    </h2>
@stop
    @section('content')
    @foreach ($teachingUnits as $teachingUnit)
        
        <div class="jumbotron">
            <h2><a href="{{ url('teaching-units/'.$teachingUnit->slug) }}" style="color: #547477">{{ $teachingUnit->title }}</a></h2>
            <!-- {!! $teachingUnit->description !!} -->
            <p><a href="{{ url('teaching-units/'.$teachingUnit->slug) }}" class="btn btn-primary btn-lg">Select<div class="ripple-container"></div></a></p>
          </div>
    @endforeach
@stop
