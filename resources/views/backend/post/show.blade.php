@extends('master')

@section('content')
	<h2>Post Title: {{$post->title}}</h2>
	<p><strong>ID:</strong> {{$post->id}}</p>
	
	<p><strong>Content:</strong> {{$post->content}}</p>
	<p><strong>Category:</strong> {{ $post->category->name}}</p>
	<p><strong>Author:</strong> {{ $post->category->name}}</p>
	<p><strong>Status:</strong>{{ $post->status}}</p>
	<p><strong>Created At:</strong> {{$post->created_at}}</p>
	
	<div>
		<a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-block">Edit</a>
		<form action="{{ route('posts.destroy',$post->id) }}" method="POST" onsubmit="confirm('Are you sure!')">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger btn-block">Delete</button>
		</form>
		<a href="{{ route('posts.index')}}" class="btn btn-primary btn-block">Back</a>
	</div>
@endsection