@extends('master')

@section('content')
	<div class="well">
		<form action="{{ route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="title">Post Title:</label>
				<input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
			</div>
			<div class="form-group">
				<label for="content">Content:</label>
				<textarea type="text" name="content" id="content" class="form-control">{{$post->content}}</textarea>
			</div>
			<div class="form-group">
				<label for="category">Category Name:</label>
				<select class="form-control" name="category" id="category">
				@foreach($categories as $category)
					<option value="{{ $category->id}}" @if($category->id == $post->category->id) selected @endif>{{$category->name}}</option>
				@endforeach
					
					
				</select>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<select class="form-control" name="status" id="status">
				<option value="active"@if($post->status=='active') selected @endif>Active</option>
				<option value="draft" @if($post->status == 'draft')
				selected @endif>Inactive</option>
				</select>
			</div>
			<div class="form-group">
				<label for="thumbnail_path">Post Image:</label>
				<input type="file" name="thumbnail_path" id="thumbnail_path" class="form-control">
			</div>
			<button type="submit" class="btn btn-success btn-block">Add Post</button>
			<a href="{{ route('posts.index')}}" class="btn btn-success btn-block">Back to Post List</a>
			
		</form>
	</div>
@endsection