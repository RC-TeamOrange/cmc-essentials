
@foreach ($questions as $question)
    <article>
        <div class="well">
            <h3 class="slide-progress"><span class="desc title">Question: </span><span class="count num current">{{ $questions->currentPage() }}</span><span class="desc separator"> of </span><span class="count num total">{{ $questions->total() }}</span></h3>
            <div class="progress">
			  <div class="progress-bar progress-bar-info" style="width: {{($questions->currentPage()/$questions->total())*100}}%"></div>
			</div>
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
        </div>
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($questions))->render($teachingUnit, $quiz) !!}
</div>
