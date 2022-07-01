@if(Session::has('successAlert'))
<script>
    showAlert('success', "{{ Session::get('successAlert') }}");
</script>
@endif

@if(Session::has('errorAlert'))
    <script>
        showAlert('danger', "{{ Session::get('errorAlert') }}");
    </script>
@endif

@if(Session::has('infoAlert'))
<script>
    showAlert('info', "{{ Session::get('infoAlert') }}");
</script>
@endif

@if(Session::has('defaultAlert'))
<script>
    showAlert('default', "{{ Session::get('defaultAlert') }}");
</script>
@endif

