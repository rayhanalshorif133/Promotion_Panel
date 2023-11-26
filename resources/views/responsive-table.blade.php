@extends('layouts.app')
@section('head')
<link rel="stylesheet"
        href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css" />
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                Dashboard
            </li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <table
                class="table table-bordered table-hover dt-responsive">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Languages</th>
                        <th>Population</th>
                        <th>Median Age</th>
                        <th>Area (Km²)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable({
                responsive: true,
                "ajax": "https://api.myjson.com/bins/1us28",
                "columns": [
                    { "data": "name" },
                    { "data": "languages" },
                    { "data": "population" },
                    { "data": "median_age" },
                    { "data": "area" }
                ]
            });
        });
    </script>
@endpush
