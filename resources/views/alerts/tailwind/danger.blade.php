@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="bg-red-200 text-red-800 border border-red-600 p-2 rounded font-sans">
	{{ $error}}
</div>
@endforeach
@endif

@if(Session::has('error'))
<div class="bg-red-200 text-red-800 border border-red-600 p-2 rounded font-sans"">
	{{ Session::get('error') }}
</div>
@endif