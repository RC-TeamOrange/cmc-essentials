<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    <div class="form-controls">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
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
    {!! Form::label('duration', 'Duration') !!}
    <div class="form-controls">
        {!! Form::number('duration', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    <div class="form-controls">
        @include('tinymce::tpl') 
        {!! Form::textarea('description', null, ['class' => 'form-control tinymce']) !!}
    </div>
</div>
{!! Form::submit('Save Unit', ['class' => 'btn btn-primary']) !!}