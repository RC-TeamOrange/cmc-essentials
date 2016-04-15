<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    <div class="form-controls">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('level', 'Level') !!}
    <div class="form-controls">
        {!! Form::number('level', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('order', 'Order') !!}
    <div class="form-controls">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Content') !!}
    <div class="form-controls">
        @include('tinymce::tpl') 
        {!! Form::textarea('description', null, ['class' => 'form-control tinymce']) !!}
    </div>
</div>

{!! Form::hidden('teaching_unit_id', $teachingUnit->id) !!}
{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}