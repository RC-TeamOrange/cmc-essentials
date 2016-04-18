@extends('layouts.master')
@section('header')
<h2>Session Login</h2>
@stop
@section('content')
<p>Please provide a username for this session.</p>
{!! Form::open(['url' => $url]) !!}
        <div class="form-group">
            <div class="form-controls">
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder'=>'username', 'autocomplete'=>'off']) !!}
            </div>
        </div>
        {!! Form::submit('Start Session', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
@stop