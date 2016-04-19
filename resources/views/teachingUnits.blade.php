@extends('layouts.master')
@section('header')
    <h2>
        Learning material
    </h2>
@stop
    @section('content')
    @foreach ($teachingUnits as $teachingUnit)

        <div class="row">
            <div class="container">
                <div class="thumbnail">
                            <a href="{{ url('teaching-units/'.$teachingUnit->slug) }}"><strong><h3>{{ $teachingUnit->title }}</h3></strong></a>
                            <p class="text-justify">{{ $teachingUnit->description }}</p>
                        </div>
                </div>
            </div>
        </div>

    @endforeach
@stop