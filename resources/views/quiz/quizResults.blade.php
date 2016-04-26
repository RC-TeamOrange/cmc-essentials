@extends('layouts.master')
@section('header')
<h2>Quiz Results</h2>
@stop
@section('content')
<?php 
    $i = 1; 
    $lables = array('A', 'B', 'C', 'D', 'E', 'F');
?>
@foreach ($questions as $question)
    <div class="question">
    <div class="question-tile"><h4>{!! $question->content !!}</h4></div>
        <table class="table quiz-result">
        <thead>
        <tr>
            <th></th>
            <th>Answers</th>
            <th>Your answer</th>
            <th>Correct answer</th>
        </tr>
        </thead>
        <tbody>
            <?php $k=0; ?>
            @foreach ($question->answers as $answer)
                    <tr>
                        <th class="qlabel">{{$lables[$k]}}</th>
                        <td class="qcontent">{!! $answer->content !!}</td>
                        @if (!empty($quizChoices) && !empty($quizChoices[$question->id]) && $answer->id == $quizChoices[$question->id])
                            @if($answer->correct == 1)
                                <td class="qchoice"><label><span class="correct">✓</span></label></td>
                            @else
                                <td class="qchoice"><label><span class="wrong">✗</span></label></td>
                            @endif
                        @else
                            <td class="qchoice"><label><span class="notselected">-</span></label></td>
                        @endif
                        @if($answer->correct == 1)
                            <td class="qchoice"><label><span class="correct">✓</span></label></td>
                        @else
                            <td class="qchoice"><label><span class="wrong">✗</span></label></td>
                        @endif
                        
                    </tr>
                    <?php $k++; ?>
            @endforeach
        </tbody>
        </table>
    </div>
    <?php $i++; ?>
@endforeach

<ul class="nav nav-pills nav-justified bottom-margin">
    <li><a href="{{ url('teaching-units') }}"><span class="glyphicon glyphicon-home"></span>&nbsp Teaching units</a></li>
    @if ($nextTeachingUnit)
        <li class="active"><a href="{{ url('teaching-units/'.$nextTeachingUnit->slug) }}">Next teaching unit &nbsp<span class="glyphicon glyphicon-triangle-right"></span></a></li>
    @endif
    <li><a href="{{ url('/') }}">Exit &nbsp<span class="glyphicon glyphicon-log-out"><span></a></li>
</ul>

@stop
