@extends('layouts.master')
@section('header')
    <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}">Back to study content</a>
    <h2>
        {{ $teachingUnit->title }} study Quizzes
    </h2>
@stop
    @section('content')
    @foreach ($quizzes as $quiz)
        <div class="quiz">
            <strong>{{ $quiz->title }}</strong>
            <a href="{{ route('teaching-units::quizzes::questions', ['teachingUnitSlug'=>$teachingUnit->slug, 'quizSlug'=>$quiz->slug]) }}">
                <strong>Start</strong>
            </a>
        </div>
    @endforeach
@stop