@extends('layouts.master')
@section('header')

@stop
@section('content')

<div class="login-container"> 
    <div class="login-card panel panel-default">
        <div class="panel-body"> 
            <h2>Session login</h2>
            <h4>You may personalize this session by providing a username.</h4>

            {!! Form::open(['url' => $url]) !!}
                    <div class="form-group">
                        <div class="form-controls">
                            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder'=>'Username', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Start session', ['class' => 'btn btn-raised btn-info center']) !!}
            {!! Form::close() !!}

            {!! Form::open(['url' => $url]) !!}
                    <div class="form-group">
                        <div class="form-controls">
                            {!! Form::hidden('username', 'Annonymous') !!}
                        </div>
                    </div>
                    {!! Form::submit('Skip Login', ['class' => 'btn btn-raised btn-info center']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="alert alert-info" role="alert">Note! If you close the web browser during learning the progress will be lost.</div>

@stop