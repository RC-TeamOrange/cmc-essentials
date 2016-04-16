@extends('layouts.master')
@section('header')
    <a href="{{ url('/dashboard') }}">Back to teaching unnits</a>
    <h2>
        {{ $teachingUnit->title }}
    </h2>
    <a href="{{ url('dashboard/teaching-units/'.$teachingUnit->id.'/edit') }}">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <a href="{{ url('dashboard/teaching-units/'.$teachingUnit->id.'/delete') }}">
        <span class="glyphicon glyphicon-trash"></span>
        Delete
    </a>
    <p>Last edited: {{ $teachingUnit->updated_at->diffForHumans() }}</p>
@stop
    @section('content')
    <div>Title: {{ $teachingUnit->title }}</div>
    <div>Level: {{ $teachingUnit->level }}</div>
    <div>Slug: {{ $teachingUnit->slug }}</div>
    <div>Duration: {{ $teachingUnit->duration }}</div>
    <div>Description: {!! $teachingUnit->description !!}</div>
    <div>
        {{ link_to('dashboard/teaching-units/'.$teachingUnit->id.'/study-materials', 'Study Materials') }}
    </div>
    <div>
        <a href="{{ route('dashboard::teaching-units::quizzes::showall', ['teachingUnitId'=>$teachingUnit->id]) }}">Quizzes</a>
    </div>
@stop