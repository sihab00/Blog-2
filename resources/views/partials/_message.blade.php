

@if(Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@elseif(Session::has('warning'))
    <div class="alert alert-danger">
        {{Session::get('warning')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif