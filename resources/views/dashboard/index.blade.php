@extends('layouts.master')
@section('header')
    <h2>
        Teaching Units
        <a href="{{ url('dashboard/teaching-units/create') }}" class="btn btn-primary pull-right">
            Create teaching unit
        </a>
    </h2>
@stop
    @section('content')
    @foreach ($teachingUnits as $teachingUnit)
        <div class="teaching-unit">
            <a href="{{ url('dashboard/teaching-units/'.$teachingUnit->id) }}">
                <strong>{{ $teachingUnit->title }}</strong>
            </a>
        </div>
    @endforeach
@stop