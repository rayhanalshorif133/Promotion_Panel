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
        <h2 class="text-3xl font-bold text-gray-700">Users</h2>
    </div>
    <div class="w-8/12 px-5 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6 class="text-xl">User's List</h6>
            <a href="{{route('user.create')}}" class="btn bg-gradient-primary">
                Add User
            </a>
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
                            Email</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Role</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Status</th>
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
    
    <script>
        $(function() {
            handleDataTable();
            handleDeleteUserItem();
        });


        const handleDeleteUserItem = () => {
            $('#userTableId').on('click', '.userDeleteBtn', function() {
                let id = $(this).attr('data-id');
           
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/user/delete/${id}`)
                            .then(function(response){
                                
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'User has been deleted.',
                                        icon: 'success',
                                        confirmButtonColor: '#0d6efd',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#userTableId').DataTable().ajax.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong.',
                                        icon: 'error',
                                        confirmButtonColor: '#0d6efd',
                                    });
                                }
                            });
                    }
                });
            });
        };


        const handleDataTable = () => {
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: function(row) {
                            if (row.role == 'admin') {
                                return "<span class='badge bg-gradient-primary'>" + row.role +
                                    "</span>";
                            } else {
                                return "<span class='badge bg-gradient-info'>" + row.role +
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
                            if (row.status == 'active') {
                                return "<span class='badge bg-gradient-success'>" + row.status +
                                    "</span>";
                            } else {
                                return "<span class='badge bg-gradient-primary'>" + row.status +
                                    "</span>";
                            }
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'status'
                    },
                    {
                        data: function(row) {

                            return `
                            <div class="mt-2 btn-group"  role="group" aria-label="Basic outlined example">
                                <a href="/user/view/${row.id}" class="px-3 btn btn-sm bg-gradient-primary" type="button"
                                 data-bs-toggle="tooltip" data-bs-placement="top" title="show details">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="/user/edit/${row.id}" class="px-3 btn btn-sm bg-gradient-info campaignEditBtn" type="button"
                                     data-bs-toggle="tooltip" data-bs-placement="top" title="Edit item">
                                     <i class="fa fa-pen"></i>
                                 </a>
                                 <button class="px-3 btn btn-sm bg-gradient-danger userDeleteBtn" data-id="${row.id}" type="button" data-bs-toggle="tooltip"
                                     data-bs-placement="top" title="Remove item">
                                     <i class="fa fa-trash"></i>
                                 </button>
                            </div>
                            `;
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'action'
                    },
                ]
            });
        };
    </script>
@endpush
