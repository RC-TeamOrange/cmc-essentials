@extends('layouts.master')
@section('header')
    <h2>
        Teaching units
    </h2>
@stop
    @section('content')
    @foreach ($teachingUnits as $teachingUnit)

        <div class="row">
            <div class="container">
                <div class="thumbnail">
                            <a href="{{ url('teaching-units/'.$teachingUnit->slug) }}" style="color: #547477"><h3>{{ $teachingUnit->title }} &nbsp<span class="glyphicon glyphicon-triangle-right"></span></h3>
                            </a>
                            <p class="text-justify">{!! $teachingUnit->description !!}</p>
                        </div>
                </div>
            </div>
        </div>

    @endforeach
@stop
