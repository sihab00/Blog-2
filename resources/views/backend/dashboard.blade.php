@extends('master')

	@section('content')
		<div class="well">
			<p>Login successfully as: {{ optional($user)->email}}</p>

			@if($user->id ==51)
				<div class="well">
					<ul>
						@foreach($user->unreadNotifications as $notification)
							<li>{{$notification->data['username']}} just registered !</li>

							@php $notification->markAsRead(); @endphp
						@endforeach
					</ul>
				</div>
			@endif		

			<img src="{{url('uploads/images/'.optional($user)->photo)}}" width="400" height="400" class="img-thumbnail">
		</div>
		<div>
			<a href="{{ route('categories.index')}}" class="btn btn-success btn-block">Category</a>
			<a href="{{ route('posts.index')}}" class="btn btn-success btn-block">Post</a>
		</div>
	@endsection
	@section('aside')
		@include('../partials._aside')
	@endsection