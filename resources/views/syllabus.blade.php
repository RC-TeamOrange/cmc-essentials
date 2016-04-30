@extends('layouts.master')
@section('header')
<h2>Syllabus</h2>
@stop
@section('content')
<div id="syllabus">
  
<div class="panel panel-default">
  <div class="panel-heading">
    <h2 class="panel-title">Teaching unit 1 : Computer Mediated Communication</h2>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <div class="list-group-item">Introduction</div>
      <div class="list-group-item">Cues filtered out</div>
      <div class="list-group-item">Cues to choose by</div>
      <div class="list-group-item">Cues filtered in</div>
      <div class="list-group-item">Cues about us</div>
      <div class="list-group-item">Cues bent and twisted</div>
      <div class="list-group-item">Quiz</div>
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2 class="panel-title">Teaching unit 2 : Theories of CMC</h2>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <div class="list-group-item">Social Information Processing Theory</div>
      <div class="list-group-item">Hyperpersonal Model</div>
      <div class="list-group-item">SIDE theory</div>
      <div class="list-group-item">Quiz</div>
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2 class="panel-title">Teaching unit 3 : Personal connections in digital spaces</h2>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <div class="list-group-item">Communication in digital spaces</div>
      <div class="list-group-item">New relationships, new selves?</div>
      <div class="list-group-item">Quiz</div>
    </div>
  </div>
</div>

</div>
<div class="text-center">
    <a href="{{ URL::route('sessionLogin')}}" class="app-nav-btn"><div class='btn-raised btn-info center bottom-margin'>Start &nbsp<span class="glyphicon glyphicon-play"></span></div></a>
</div>

@stop
