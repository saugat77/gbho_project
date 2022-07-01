@if(Session::has('success'))
<div class="bg-green-200 text-green-800 border border-green-600 p-2 rounded font-sans">
    {{ Session::get('success') }}
</div>
@endif