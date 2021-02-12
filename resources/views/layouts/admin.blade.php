@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@stop

@section('js')

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('.datatables').DataTable();
        } );
    </script>

@stop
