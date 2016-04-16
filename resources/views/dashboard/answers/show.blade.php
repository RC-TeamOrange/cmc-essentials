@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::showall', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}">Back to answer choices</a>
    <h2>
        {!! $answer->content !!}
    </h2>
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::edit', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id, 'answerId'=>$answer->id]) }}">
        <span class="glyphicon glyphicon-edit"></span>
        Edit
    </a>
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::delete', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id, 'answerId'=>$answer->id]) }}">
        <span class="glyphicon glyphicon-trash"></span>
        Delete
    </a>
    <p>Last edited: {{ $answer->updated_at->diffForHumans() }}</p>
@stop
    @section('content')
    <div>Answer: {!! $answer->content !!}</div>
    <div>Position: {{ $answer->rank }}</div>
    <div>Correct: {{ $answer->correct }}</div>
@stop