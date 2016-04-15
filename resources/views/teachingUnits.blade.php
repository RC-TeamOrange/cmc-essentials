@extends('layouts.master')
@section('header')
    <h2>
        Select a teaching unit to start.
    </h2>
@stop
    @section('content')
    @foreach ($teachingUnits as $teachingUnit)
        <div class="teaching-unit">
            <a href="{{ url('teaching-units/'.$teachingUnit->slug) }}">
                <strong>{{ $teachingUnit->title }}</strong>
            </a>
        </div>
    @endforeach
@stop