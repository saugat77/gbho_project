@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert danger-color  text-white alert-dismissible fade show z-depth-1 w-responsive" role="alert">
	{{ $error}}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true" class="text-white">&times;</span>
	</button>
</div>
@endforeach
@endif

@if(Session::has('error'))
<div class="alert danger-color  text-white alert-dismissible fade show z-depth-1" role="alert">
	{{ Session::get('error') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true" class="text-white">&times;</span>
	</button>
</div>
@endif