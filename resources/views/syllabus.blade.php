@extends('layouts.master')
@section('header')
<h2>CMC-Essentials Syllabus</h2>
@stop
@section('content')

<ul class="a">
  <li>Unit 1 : Computer Mediated Communication</li>
    <ul class="b">
        <li>Introduction</li>
        <li>Cues Filtered out</li>
        <li>Cues to choose by</li>
        <li>Cues Filtered in</li>
        <li>Cues about us</li>
        <li>Cues bent and Twisted</li>
    </ul>
    <br>

 <li>Unit 2 : Theories of CMC</li>
    <ul class="b">
        <li>Social Information Processing Theory</li>
        <li>Hyperpersonal Model</li>
        <li>SIDE theory</li>
    </ul>
    <br>

 <li>Unit 3 : Personal connections in digital spaces</li>
      <ul class="b">
        <li>Communication in digital spaces</li>
        <li>New relationships, new selves?</li>
    </ul>
    <br>

  <li>Quiz</li>
  <br>

  <li>References</li>
  <br>

</ul>

<a href="{{ route('sessionLogin') }}">Start</a>
@stop
