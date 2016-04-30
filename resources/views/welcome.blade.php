@extends('layouts.master')
@section('header')

@stop
@section('content')
<div class="panel panel-default">
  <div class="panel-body">
    <h2>Welcome to CMC-Essentials</h2>
    <h4>
    <p>The website is intended to help you learn about Computer-Mediated-Communication (CMC).</p>
    <p>In the next page you will see a short syllabus with the available teaching units.</p>
    <p>Furthermore, by taking a teaching unit from this website you will be able to check your gained knowledge by finishing it with a quiz.</p>
    <p>We hope you will find it interesting and it will help you discover the world of the CMC.</p>
    <p>Enjoy your learning session!</p>
    </h4>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-body">
    <img src="../../../media/cmc-emotions-romance.jpg" class="img-responsive center-block"></img>
    <div class="caption text-center">
        <span class="image-credits"><a href="http://onlinedatingisys2015.blogspot.de/2015/10/pros-and-cons-of-online-dating.html">Image credits: onlinedatingisys2015.blogspot.de</a></span>
    </div>
  </div>
</div>

<br>

<div class="text-center">
<a href="{{ URL::route('syllabus')}}" class="app-nav-btn"><div class='btn-raised btn-info center bottom-margin'>Next &nbsp <span class="glyphicon glyphicon-chevron-right"></span></div></a>
</div>

@stop
