<div class="form-group">
    {!! Form::label('rank', 'Position') !!}
    <div class="form-controls">
        {!! Form::number('rank', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('correct', 'Correct') !!}
    <div class="form-controls">
        {!! Form::select('correct', array(0 => 'Wrong', 1 => 'Correct'), 0, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    <div class="form-controls">
        @include('tinymce::tpl') 
        {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
    </div>
</div>

{!! Form::hidden('question_id', $question->id) !!}
{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}