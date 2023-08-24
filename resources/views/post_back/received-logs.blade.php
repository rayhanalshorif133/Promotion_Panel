@extends('layouts.app')

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
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Received Logs</h2>
    </div>

    <div class="w-full px-[2rem] mx-auto lg:px-[4rem] lg:w-8/12 card py-5">
        <div class="flex flex-col justify-between px-4 my-4 sm:flex-row">
            <h6>Post Back Receives Logs</h6>
        </div>
        <div class="px-5 table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="postBackReceivesLogsTableId">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Clicked Id</th>
                        <th>Service Name</th>
                        <th>Operator Name</th>
                        <th>Received At</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#postBackReceivesLogsTableId').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                responsive: true,
                ajax: "{{ route('post-back.received-logs') }}",
                columns: [{
                        data: function(row, type, set, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'item'
                    },
                    {
                        data: 'clicked_id',
                        name: 'clicked_id',
                        searchable: true,
                        className: "text-center"
                    },
                    {
                        data: 'service_name',
                        name: 'service_name',
                        searchable: true,
                        className: "text-center"
                    },
                    {
                        data: 'operator_name',
                        name: 'operator_name',
                        searchable: true,
                        className: "text-center"
                    },
                    {
                        data: 'received_at',
                        name: 'received_at',
                        searchable: true,
                        className: "text-center"
                    },
                ]
            });
        });
    </script>
@endpush
