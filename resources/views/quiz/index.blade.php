@extends('layouts.master')
@section('header')
    <a href="{{ route('teaching-units::study', ['slug'=>$teachingUnit->slug]) }}" style="color: #547477"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Back to teaching unit</a>
    <h2
        {{ $teachingUnit->title }} quiz
    </h2>
@stop
@section('content')
    <h4>Test the gained knowledge by answering the questions in the following quiz.</h4>
    <div class="alert alert-info" role="alert">Note! Only one answer is correct. Good luck!</div>

    <img src="../../../media/quiz.png" class="img-responsive center-block"></img>
    <br>

    <div class="caption text-center">
        <span class="image-credits"><a href="http://granitegrok.com/blog/2013/07/republican-vote-stealer/attachment/question-mark">Image credits: granitegrok.com</a></span>
    </div>

    <br>

    @foreach ($quizzes as $quiz)
    <div class="quiz text-center">
        <a href="{{ route('teaching-units::quizzes::questions', ['teachingUnitSlug'=>$teachingUnit->slug, 'quizSlug'=>$quiz->slug]) }}" class="app-nav-btn"><div class='btn-raised btn-info center bottom-margin'>Start &nbsp<span class="glyphicon glyphicon-play"></span></div></a>
    </div>
    @endforeach
@stop