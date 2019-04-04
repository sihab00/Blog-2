@extends('master')

@section('content')
	<div>
		<a href="{{ route('categories.create') }}" class="btn btn-primary btn-block">Create Category</a>
	</div>
	<div>
	<h2 class="text-center">Category List</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Slug</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($categories as $category)
				<tr>
					<th>{{ $category->id }}</th>
					<td>{{ $category->name }}</td>
					<td>{{ $category->slug }}</td>
					<td>{{ $category->status == 1 ? 'Active':'Inactive' }}</td>
					<td>
						<a href="{{ route('categories.show',$category->id)}}" class="btn btn-secondary">Details</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $categories->links()}}
	</div>
@endsection

@section('aside')
	@include('partials._aside')
@endsection