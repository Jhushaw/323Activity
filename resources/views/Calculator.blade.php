@extends('layouts.appmaster')
@section('title','Calculator')

@section('content')
<div class="container">
<form action="calculate" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Calculator</h2>
	<p>(try me)
	<table>
		<tr>
			<td>First Number:</td>
			<td><input type="text" name="firstnum" maxlength="10"/></td>
		</tr>
		<tr>
			<td>Second Number</td>
			<td><input type="text" name="secondnum" /> </td>
		</tr>
		<tr>
			<td>Type Your Oporator:(+ , -, /, *)</td>
			<td><input type="text" name="oporator" /> </td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="calculate" /></td>
		</tr>
	</table>
</form>
@if($errors->count() != 0)
	<h5>List of Errors</h5>
	@foreach($errors->all() as $message)
		{{ $message }} <br>
	@endforeach
@endif
@endsection
</div>
