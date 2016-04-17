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
        <table>
        <tr>
            <th></th>
            <th>Choice</th>
            <th>Your Response</th>
            <th>Correct Choice</th>
        </tr>
            <?php $k=0; ?>
            @foreach ($question->answers as $answer)
                    <tr>
                        <td>{{$lables[$k]}}</td>
                        <td>{!! $answer->content !!}</td>
                        @if (!empty($quizChoices) && $quizChoices[$question->id] && $answer->id == $quizChoices[$question->id])
                            @if($answer->correct == 1)
                                <td><span class="correct">1</span></td>
                            @else
                                <td><span class="wrong">0</span></td>
                            @endif
                        @else
                            <td><span class="notselected">-</span></td>
                        @endif
                        @if($answer->correct == 1)
                            <td><span class="correct">1</span></td>
                        @else
                            <td><span class="wrong">0</span></td>
                        @endif
                        
                    </tr>
                    <?php $k++; ?>
            @endforeach
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
