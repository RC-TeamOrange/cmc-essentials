@extends('layouts.master')
@section('header')
<h2>Your Quiz Results</h2>
@stop
@section('content')
<p>Results</p>
<?php 
    $i = 1; 
    $lables = array('A', 'B', 'C', 'D', 'E', 'F');
?>
@foreach ($questions as $question)
    <div class="question">
    <span class="numbering">{{$i}}</span>
    <div class="question-tile">{!! $question->content !!}</div>
        <table class="table quiz-result">
        <thead>
        <tr>
            <th></th>
            <th>Choice</th>
            <th>Your Response</th>
            <th>Correct Choice</th>
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

@if ($nextTeachingUnit)
    <div class="next-action">
        <a href="{{ url('teaching-units/'.$nextTeachingUnit->slug) }}">Next Teaching Unit</a>
    </div>
@else
    <div class="next-action">
        End of Study
    </div>
@endif
<div class="next-action">
    <a href="{{ url('teaching-units') }}">Back to Selection Page</a>
</div>

<div class="next-action">
    <a href="{{ url('/') }}">Exit</a>
</div>
@stop
