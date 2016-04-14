@extends('layouts.master')
@section('header')
    <a href="{{ url('/') }}">Back to teaching unnits</a>
    <h2>
        {{ $teachingUnit->name }}
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
    <p>Title: {{ $teachingUnit->title }}</p>
    <p>
        @if ($teachingUnit->description)
            Study Material:
            {{ link_to('dashboard/teaching-units/'.$teachingUnit->id.'/study-materials', $teachingUnit->title) }}
        @endif
    </p>
@stop