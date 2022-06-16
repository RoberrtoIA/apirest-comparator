{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
 --}}

{{-- <script type="text/javascript">
    window.location = "";//here double curly bracket
</script> --}}
<?php
header('Location: http://127.0.0.1:8000/');
?>
