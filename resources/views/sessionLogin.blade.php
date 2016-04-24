@extends('layouts.master')
@section('header')
<h2>Session login</h2>
@stop
@section('content')
<h4>In order to start the learning start you should enter a username in the form below.</h4>

{!! Form::open(['url' => $url]) !!}
        <div class="form-group">
            <div class="form-controls">
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder'=>'Username', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        {!! Form::submit('Start session', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br>

<div class="alert alert-info" role="alert">Note! If you close the web browser during learning the progress will be lost.</div>

@stop