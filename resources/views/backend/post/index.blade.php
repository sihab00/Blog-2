@extends('master')

@section('content')
	<div>
		<a href="{{ route('posts.create') }}" class="btn btn-primary btn-block">Create Post</a>
	</div>
	<div>
	<h2 class="text-center">Post List</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Category</th>
					<th>Author</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>{{ $post->category->name }}</td>
					<td>{{ $post->user->username }}</td>
					<td>{{ $post->status}}</td>
					<td>
						<a href="{{ route('posts.show',$post->id)}}" class="btn btn-secondary">Details</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $posts->links()}}
	</div>
@endsection

@section('aside')
	@include('partials._aside')
@endsection