@extends('layouts.master')
@section('header')
<h2>Syllabus</h2>
@stop
@section('content')

<div class="list-group">
  <h4>
  <div class="list-group-item active">Teaching unit 1 : Computer Mediated Communication</div>
  <div class="list-group-item">Introduction</div>
  <div class="list-group-item">Cues Filtered out</div>
  <div class="list-group-item">Cues to choose by</div>
  <div class="list-group-item">Cues Filtered in</div>
  <div class="list-group-item">Cues about us</div>
  <div class="list-group-item">Cues bent and Twisted</div>
  <div class="list-group-item">Quiz</div>

  <div class="list-group-item active">Teaching unit 2 : Theories of CMC</div>
  <div class="list-group-item">Social Information Processing Theory</div>
  <div class="list-group-item">Hyperpersonal Model</div>
  <div class="list-group-item">SIDE theory</div>
  <div class="list-group-item">Quiz</div>

  <div class="list-group-item active">Teaching unit 3 : Personal connections in digital spaces</div>
  <div class="list-group-item">Communication in digital spaces</div>
  <div class="list-group-item">New relationships, new selves?</div>
  <div class="list-group-item">Quiz</div>
  </h4>

</div>

<div class="text-center">
    <a href="{{ URL::route('sessionLogin')}}"><div class='btn btn-primary bottom-margin'>Start &nbsp<span class="glyphicon glyphicon-play"></span></div></a>
</div>

@stop
