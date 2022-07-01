@if(Session::has('warning'))
<div class="alert warning-color  text-white alert-dismissible fade show z-depth-1" role="alert">
	{{ Session::get('warning') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true" class="text-white">&times;</span>
	</button>
</div>
@endif