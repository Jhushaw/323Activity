@extends('layouts.appmaster')
@section('title','Calculator')

@section('content')
<div class="container">
@if (isset($results))
<table id="UserTable" border="1">
	<tr>
		<th>First Number</th>
		<th>Oporator</th>
		<th>Second Number</th>
		<th>Result</th>

	</tr>
	@foreach ($results as $r)
	<tr>
		<td>{{ $r['FIRSTNUM']}}</td>
		<td>{{ $r['OPORATOR']}}</td>
		<td>{{ $r['SECONDNUM']}}</td>
		<td>{{ $r['RESULT']}}</td>

	</tr>
	@endforeach
</table>
@endif
</div>
@endsection