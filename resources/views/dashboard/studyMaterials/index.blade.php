@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::show', ['id'=>$teachingUnit->id]) }}">Back to teaching unit</a>
    <h2>
        {{ $teachingUnit->title }} study Materials
        <a href="{{ route('dashboard::teaching-units::study-materials::create', ['teachingUnitId'=>$teachingUnit->id]) }}" class="btn btn-primary pull-right">
            Create study material
        </a>
    </h2>
@stop
    @section('content')
    @foreach ($studyMaterials as $studyMaterial)
        <div class="teaching-unit">
            <a href="{{ route('dashboard::teaching-units::study-materials::show', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$studyMaterial->id]) }}">
                <strong>{{ $studyMaterial->title }}</strong>
            </a>
        </div>
    @endforeach
@stop