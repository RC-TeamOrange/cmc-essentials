@extends('layouts.master')
@section('header')
<h2>Your Quiz Results</h2>
@stop
@section('content')
<p>Results</p>

@if ($nextTeachingUnit)
    <div class="next-action">
        <a href="{{ url('teaching-units/'.$nextTeachingUnit->slug) }}">Next Teaching Unit</a>
    </div>
@else
    <div class="next-action">
        End of Study
    </div>
@endif
<div class="next-action">
    <a href="{{ url('teaching-units') }}">Back to Selection Page</a>
</div>

<div class="next-action">
    <a href="{{ url('/') }}">Exit</a>
</div>
@stop
