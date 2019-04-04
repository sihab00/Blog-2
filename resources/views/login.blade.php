@extends('master');
@section('content')
	<h2 class="text-center">Login</h2>
	{!! Form::open(['route'=>'login','method'=>'POST']) !!}

		{{ Form::label('email','Email:')}}
		{{ Form::text('email',old('email'),['class'=>'form-control'])}}

		
		{{ Form::label('password','Password:')}}
		{{ Form::password('password',['class'=>'form-control'],old('password'))}}

		{{ Form::submit('Login',['class'=>'btn btn-success btn-lg mt-2'])}}

	{!! Form::close() !!}
@endsection