@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	{{ Session::get('success') }}
	<button type="button" class="close font-roboto" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true" class="text-white">&times;</span>
	</button>
</div>
@endif