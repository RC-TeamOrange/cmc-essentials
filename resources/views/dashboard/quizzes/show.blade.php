@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::quizzes::showall', ['teachingUnitId'=>$teachingUnit->id]) }}">Back to {{ $teachingUnit->title }} quizzes</a>
    <h2>
        {{ $quiz->title }}
    </h2>
    <a href="{{ route('dashboard::teaching-units::quizzes::edit', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$quiz->id]) }}">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <a href="{{ route('dashboard::teaching-units::quizzes::delete', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$quiz->id]) }}">
        <span class="glyphicon glyphicon-trash"></span>
        Delete
    </a>
    <p>Last edited: {{ $quiz->updated_at->diffForHumans() }}</p>
@stop
    @section('content')
    <div>Title: {{ $quiz->title }}</div>
    <div>Slug: {{ $quiz->slug }}</div>
    <div>Order: {{ $quiz->level }}</div>
    <div>
        <a href="{{ route('dashboard::teaching-units::quizzes::questions::showall', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id]) }}">Questions</a>
    </div>
@stop