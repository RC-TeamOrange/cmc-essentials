@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::quizzes::show', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id]) }}">Back to quiz</a>
    <h2>
        {{ $quiz->title }} study Questions
        <a href="{{ route('dashboard::teaching-units::quizzes::questions::create', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id]) }}" class="btn btn-primary pull-right">
            Create Question
        </a>
    </h2>
@stop
    @section('content')
    @foreach ($questions as $question)
        <div class="question">
            <a href="{{ route('dashboard::teaching-units::quizzes::questions::show', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId' => $question->id]) }}">
                <strong>{!! $question->content !!}</strong>
            </a>
        </div>
    @endforeach
@stop