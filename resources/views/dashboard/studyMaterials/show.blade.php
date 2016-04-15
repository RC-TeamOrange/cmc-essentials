@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::study-materials::showall', ['teachingUnitId'=>$teachingUnit->id]) }}">Back to {{ $teachingUnit->title }} study materials</a>
    <h2>
        {{ $studyMaterial->title }}
    </h2>
    <a href="{{ route('dashboard::teaching-units::study-materials::edit', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$studyMaterial->id]) }}">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <a href="{{ route('dashboard::teaching-units::study-materials::delete', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$studyMaterial->id]) }}">
        <span class="glyphicon glyphicon-trash"></span>
        Delete
    </a>
    <p>Last edited: {{ $teachingUnit->updated_at->diffForHumans() }}</p>
@stop
    @section('content')
    <div>Title: {{ $studyMaterial->title }}</div>
    <div>Level: {{ $studyMaterial->level }}</div>
    <div>Order: {{ $studyMaterial->order }}</div>
    <div>Content: {!! $studyMaterial->description !!}</div>
@stop