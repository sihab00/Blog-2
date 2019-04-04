@extends('master')

@section('content')
	<div class="well">
		<form action="{{ route('categories.update',$category->id)}}" method="post">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="name">Category Name:</label>
				<input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
			</div>
			<div class="form-group">
				<label for="status">Category Name:</label>
				<select class="form-control" name="status" id="status">
					<option value="1" @if($category->status ==1) selected @endif>Active</option>
					<option value="0" @if($category->status ==0) selected @endif>Inactive</option>
				</select>
			</div>
			<button type="submit" class="btn btn-success btn-block">Add Category</button>
			<a href="{{ route('categories.index')}}" class="btn btn-success btn-block">Back to Category List</a>
			
		</form>
	</div>
@endsection