
@foreach ($questions as $question)
    <article>
        <h2>{!! $question->content !!}</h2>
        <?php 
            $i = 0; 
            $lables = array('A', 'B', 'C', 'D', 'E', 'F');
        ?>
        <input type="hidden" id="questionId" value="{{ $question->id }}" />
        <table class="table answer-choices">
            <tbody>
        @foreach ($answerChoices as $answerChoice)
            <tr>
                <th scope="row">{{ $lables[$i] }}</th>
                <td>
                <span class="choice-text"><label for="{{$answerChoice->id}}">{!! $answerChoice->content !!}</label></span>
                </td>
                <td>
                @if(!empty($quizChoices[$question->id]) && $quizChoices[$question->id] == $answerChoice->id)
                    <input id="{{$answerChoice->id}}" type="radio" name="choice" checked="checked" /><label for="{{$answerChoice->id}}"><span><span></span></span></label>
                @else
                    <input id="{{$answerChoice->id}}" type="radio" name="choice" /><label for="{{$answerChoice->id}}"><span><span></span></span></label>
                @endif
                </td>
            <?php $i++;  ?>
            </tr>
        @endforeach
        </tbody>
        </table>
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($questions))->render($teachingUnit, $quiz) !!}
</div>
