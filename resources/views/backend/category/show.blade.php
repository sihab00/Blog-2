@extends('master')

@section('content')
	<h2>Name: {{$category->name}}</h2>
	<p>ID: {{$category->id}}</p>
	
	<p>Slug: {{$category->slug}}</p>
	<p>Status: {{ $category->status == 1 ? 'Active':'Inactive'}}</p>
	<p>Created At: {{$category->created_at}}</p>
	<div class="well">
		<h2>Post List under this Category</h2>
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
			@foreach($category->posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>{{ $post->category->name }}</td>
					<td>{{ $post->user->username}}</td>
					<td>{{ $post->status}}</td>
					<td>
						<a href="{{ route('posts.show',$post->id)}}" class="btn btn-secondary">Details</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	<div>
		<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary btn-block">Edit</a>
		<form action="{{ route('categories.destroy',$category->id) }}" method="POST" onsubmit="confirm('Are you sure!')">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger btn-block">Delete</button>
		</form>
		<a href="{{ route('categories.index')}}" class="btn btn-primary btn-block">Back</a>
	</div>
@endsection