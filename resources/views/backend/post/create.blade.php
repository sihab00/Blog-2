@extends('master')

@section('content')
	<div class="well">
		<form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="title">Post Title:</label>
				<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
			</div>
			<div class="form-group">
				<label for="content">Content:</label>
				<textarea type="text" name="content" id="content" class="form-control">{{old('content')}}</textarea>
			</div>
			<div class="form-group">
				<label for="category">Category Name:</label>
				<select class="form-control" name="category" id="category">
				<option value="">Choose One</option>
				@foreach($posts as $post)
					<option value="{{$post->category->id}}">{{$post->category->name}}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="user">User Name:</label>
				<select name="user" class="form-control">
					<option value="{{auth()->user()->id}}">{{auth()->user()->username}}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<select class="form-control" name="status" id="status">
				<option value="active">Active</option>
				<option value="draft">Inactive</option>
				</select>
			</div>
			<div class="form-group">
				<label for="thumbnail_path">Post Image:</label>
				<input type="file" name="thumbnail_path" id="thumbnail_path" class="form-control">
			</div>
			<button type="submit" class="btn btn-success btn-block">Add Post</button>
			<a href="{{ route('posts.index')}}" class="btn btn-success btn-block">Back to Category List</a>
			
		</form>
	</div>
@endsection