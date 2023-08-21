@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">User</h2>
    </div>
    <div class="w-8/12 px-5 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6>Country's List</h6>
            <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createCountry">
                Add Country
            </button>
        </div>
        <div class="table-responsive">
            <table class="table px-2 pb-3 mb-0 align-items-start" id="userTableId">
                <thead>
                    <tr>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            #</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Name</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Role</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- data: 'DT_RowIndex',
                        name: 'DT_RowIndex' --}}
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#userTableId').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: function(row, type, set, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searchable: false,
                        orderable: false,
                        className: "align-self-start text-start",
                        name: 'item'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: function(row) {
                            if (row.role == 'admin') {
                                return "<span class='badge bg-gradient-success'>" + row.role +
                                    "</span>";
                            } else {
                                return "<span class='badge bg-gradient-primary'>" + row.role +
                                    "</span>";
                            }
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'role'
                    },
                    {
                        data: function(row) {
                            return `<a href='/user/edit/${row.id}' class='btn btn-sm bg-gradient-warning'>Edit</a>`;
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endpush
