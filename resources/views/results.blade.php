@extends('layouts.appmaster')
@section('title','Calculator')

@section('content')
<div class="container">
<h2>Here are your Results</h2>
	<p>{{$result->getFirstnum()}}  {{$result->getOporator()}} {{$result->getSecondnum()}} = {{$result->getResult()}}</p>
	<br>
	<a href = "calculator">Run Again</a>
</div>
@endsection