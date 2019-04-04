@extends('master')

@section('content')
	<div class="well">
		<form action="{{ route('categories.store')}}" method="post">
			@csrf
			<div class="form-group">
				<label for="name">Category Name:</label>
				<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
			</div>
			<div class="form-group">
				<label for="status">Category Name:</label>
				<select class="form-control" name="status" id="status">
					<option value="1">Active</option>
					<option value="0">Inactive</option>
				</select>
			</div>
			<button type="submit" class="btn btn-success btn-block">Add Category</button>
			<a href="{{ route('categories.index')}}" class="btn btn-success btn-block">Back to Category List</a>
			
		</form>
	</div>
@endsection