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
                Publisher's List
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Publisher</h2>
    </div>

    <div class="w-full px-[2rem] mx-auto lg:px-[4rem] lg:w-8/12 card">
        <div class="flex flex-col justify-between px-4 my-4 sm:flex-row">
            <h6>Publisher's List</h6>
            <button class="btn bg-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPublisher">
                Add Publisher
            </button>
        </div>
        <div class="px-5 py-5 table-responsive">

            <table class="table table-bordered table-hover dt-responsive" id="publisherTableId">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Post Back URL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('publisher.createAndUpdate')
@endsection
@push('scripts')
    <script>
        $(function() {
            handleDataTable();
            handleDeleteItem();
        });

        const handleDeleteItem = () => {
            $('#campaignTableId').on('click', '.campaignItemDeleteBtn', function() {
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
                        axios.delete(`/campaign/delete/${id}`)
                            .then(function(response) {

                                if (response.status) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Campaign has been deleted.',
                                        icon: 'success',
                                        confirmButtonColor: '#0d6efd',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#campaignTableId').DataTable().ajax.reload();
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

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'User has been deleted.',
                                        icon: 'success',
                                        confirmButtonColor: '#0d6efd',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#campaignTableId').DataTable().ajax
                                                .reload();
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
                            }
                        });
                    }
                });
            });
        };

        const handleDataTable = () => {
            $('#publisherTableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('publisher.index') }}",
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
                        data: 'name',
                        name: 'name',
                        className: "text-center"
                    },
                    {
                        data: 'short_name',
                        name: 'short_name',
                        className: "text-center"
                    },
                    {
                        data: function(row) {
                            if (row.post_back_url) {
                                return row.post_back_url;
                            } else {
                                return "<span class='badge bg-gradient-secondary'>Not Set</span>";
                            }
                        },
                        searchable: false,
                        orderable: false,
                        className: "text-center",
                        name: 'post_back_url'
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
                            <div class="btn-group" data-id=${row.id} role="group" aria-label="Basic outlined example">
                                    <button class="px-3 btn btn-sm bg-gradient-info publisherEditBtn" data-bs-toggle="modal" data-bs-target="#updatePublisher"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit item">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="px-3 btn btn-sm bg-gradient-danger publisherDeleteBtn"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove item">
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
            publisherEditAndDeleteBtnHandler();
        };

        const publisherEditAndDeleteBtnHandler = () => {
            $(document).on('click', '.publisherEditBtn', function() {
                const id = $(this).parent().attr('data-id');
                axios.get(`publisher/fetch/${id}`)
                    .then(function(res) {
                        const data = res.data.data;
                        $("#publisher_id").val(data.id);
                        $("#updateName").val(data.name);
                        $("#updateShortName").val(data.short_name);
                        $("#update_post_back_url").val(data.post_back_url);
                        $("#updateStatus").val(data.status);
                    });
            });

            $(document).on('click', '.publisherDeleteBtn', function() {
                const id = $(this).parent().attr('data-id');
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`publisher/delete/${id}`)
                            .then(function(res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            });

                    }
                })
            });
        };
    </script>
@endpush
