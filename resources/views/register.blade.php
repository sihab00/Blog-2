@extends('master')

@section('content')
	<h2 class="text-center">Create an accounts</h2>
	
	{!! Form::open(['route'=>'register','method'=>'POST','files'=>'true']) !!}

		{{ Form::label('email','Email:')}}
		{{ Form::text('email',old('email'),['class'=>'form-control'])}}

		{{ Form::label('username','Username:')}}
		{{ Form::text('username',old('username'),['class'=>'form-control'])}}

		{{ Form::label('password','Password:')}}
		{{ Form::password('password',['class'=>'form-control'],old('password'))}}

		{{ Form::label('phone_number','Phone Number:')}}
		{{ Form::text('phone_number',old('phone_number'),['class'=>'form-control'])}}

		{{ Form::label('image','Image:')}}
		{{ Form::file('image',['class'=>'form-control'])}}

		{{ Form::submit('Register',['class'=>'btn btn-success btn-lg mt-2'])}}

	{!! Form::close() !!}

@endsection