@extends('layouts.master')
@section('header')
<h2>CMC-Essentials Syllabus</h2>
@stop
@section('content')
<p>Syllabus</p>
<a href="{{ route('teaching-units::showall') }}">Start</a>
@stop
