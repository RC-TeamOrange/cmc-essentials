
@foreach ($questions as $question)
    <article>
        <h2>{!! $question->content !!}</h2>
        <input type="hidden" id="questionId" value="{{ $question->id }}" />
        @foreach ($answerChoices as $answerChoice)
            <div class="answerchoice">
                <span class="choice-text"><label for="{{$answerChoice->id}}">{!! $answerChoice->content !!}</label></span>
                @if(!empty($quizChoices[$question->id]) && $quizChoices[$question->id] == $answerChoice->id)
                    <input id="{{$answerChoice->id}}" type="radio" name="choice" checked="checked" />
                @else
                    <input id="{{$answerChoice->id}}" type="radio" name="choice" />
                @endif
            </div>
        @endforeach
    </article>
@endforeach
   
<div class="pager">
{!! with(new CmcEssentials\PaginationPresenter($questions))->render($teachingUnit, $quiz) !!}
</div>
