@extends('layouts.master')
@section('header')
    <a href="{{ route('dashboard::teaching-units::show', ['id'=>$teachingUnit->id]) }}">Back to teaching unit</a>
    <h2>
        {{ $teachingUnit->title }} study Quizzes
        <a href="{{ route('dashboard::teaching-units::quizzes::create', ['teachingUnitId'=>$teachingUnit->id]) }}" class="btn btn-primary pull-right">
            Create Quiz
        </a>
    </h2>
@stop
    @section('content')
    @foreach ($quizzes as $quiz)
        <div class="quiz">
            <a href="{{ route('dashboard::teaching-units::quizzes::show', ['teachingUnitId'=>$teachingUnit->id, 'id'=>$quiz->id]) }}">
                <strong>{{ $quiz->title }}</strong>
            </a>
        </div>
    @endforeach
@stop