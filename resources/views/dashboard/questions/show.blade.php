@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::showall', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id]) }}">Back to {{ $quiz->title }} questions</a>
    <h2>
        {!! $question->content !!}
    </h2>
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::edit', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::delete', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}">
        <span class="glyphicon glyphicon-trash"></span>
        Delete
    </a>
    <p>Last edited: {{ $question->updated_at->diffForHumans() }}</p>
@stop
    @section('content')
    <div>Question: {!! $question->content !!}</div>
    <div>
        <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::showall', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}">Answer Choices</a>
    </div>
@stop