@extends('layout.main')

@section('content')
	<form action="{{ URL::route('account-create-post') }}" method="post">
		<div class="field">
			Enail: <input type="text" name="email">
			@if($errors->has('email'))
				{{ $error->first('email') }}
			@endif
		</div>
		<div class="field">
			Username: <input type="text" name="username">
		</div>
		<div class="field">
			Password: <input type="password" name="password">
		</div>
		<div class="field">
			Password again: <input type="password" name="password_again">
		</div>
		<input type="submit" value="Create Account">
		{{ Form::token() }}
	</form>
@stop