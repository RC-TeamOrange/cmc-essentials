<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    <div class="form-controls">
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('level', 'Level') !!}
    <div class="form-controls">
        {!! Form::number('level', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    <div class="form-controls">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::hidden('teaching_unit_id', $teachingUnit->id) !!}
{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}