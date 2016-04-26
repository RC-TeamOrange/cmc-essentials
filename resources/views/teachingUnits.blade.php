@extends('layouts.master')
@section('header')
    <a href="{{ url('/syllabus') }}" style="color: #547477"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Back to syllabus</a>
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
                            <p>{!! $teachingUnit->description !!}</p>
                        </div>
                </div>
            </div>
        </div>

    @endforeach
@stop
