@extends('layouts.master')
@section('header')
<h2>Welcome to CMC-Essentials</h2>
@stop
@section('content')

<h4>
<p>The website is intended to help you learn about Computer-Mediated-Communication (CMC).</p>
<p>In the next page you will see a short syllabus with the available learning material.</p>
<p>Furthermore, by taking a teaching unit from this website you will be able to check your gained knowledge by finishing it with a quiz.</p>
<p>We hope you will find it interesting and it will help you discover the world of the CMC.</p>
<p>Enjoy your learning session!</p>
</h4>

<img src="../../../media/cmc-emotions-romance.jpg" class="img-responsive center-block"></img>

<br>

<div class="text-center">
<a href="{{ URL::route('syllabus')}}"><div class='btn btn-primary center'>Next</div></a>
</div>

@stop
