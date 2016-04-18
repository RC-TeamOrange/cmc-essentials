<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    <div class="form-controls">
        @include('tinymce::tpl') 
        {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
    </div>
</div>

{!! Form::hidden('quiz_id', $quiz->id) !!}
{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}