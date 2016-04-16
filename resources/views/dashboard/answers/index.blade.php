@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::quizzes::questions::show', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}">Back to question</a>
    <h2>
        {!! $question->content !!} : Answer choices.
        <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::create', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId'=>$question->id]) }}" class="btn btn-primary pull-right">
            Create Answer Choice
        </a>
    </h2>
@stop
    @section('content')
    @foreach ($answers as $answer)
        <div class="answer">
            <a href="{{ route('dashboard::teaching-units::quizzes::questions::answers::show', ['teachingUnitId'=>$teachingUnit->id, 'quizId'=>$quiz->id, 'questionId' => $question->id, 'answerId'=>$answer->id]) }}">
                <strong>{!! $answer->content !!}</strong>
            </a>
        </div>
    @endforeach
@stop