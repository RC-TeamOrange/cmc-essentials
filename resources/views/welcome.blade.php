@extends('layouts.master')
@section('header')
<h2>Welcome to CMC-Essentials</h2>
@stop
@section('content')

<p>The website is intended to help you learn about Computer-Mediated-Communication (CMC).</p>

<a href="{{ URL::route('syllabus')}}"><div class='btn btn-primary'>NEXT</div></a>

@stop
