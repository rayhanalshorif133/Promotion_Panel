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
                Traffic List
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Traffics</h2>
    </div>

    <div class="w-10/12 px-5 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6 class="text-xl">Traffic's List</h6>
        </div>
        <div class="py-4 table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="trafficTableId">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            Clicked Id</th>
                        <th>
                            Campaign Name</th>
                        <th>
                            Service Name
                        </th>
                        <th>
                            Operator Name
                        </th>
                        <th>
                            Post Back Received
                        </th>
                        <th>
                            Post Back Sent
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    @include('traffic.show')
@endsection

@push('scripts')
    <script>
        $(function() {
            handleDataTable();
            handleDeleteTrafficItem();
        });

        const handleDeleteTrafficItem = () => {
            $('#trafficTableId').on('click', '.trafficDeleteBtn', function() {
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
                        axios.delete(`/traffic/delete/${id}`)
                            .then(function(response){
                                
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Traffic has been deleted.',
                                        icon: 'success',
                                        confirmButtonColor: '#0d6efd',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#trafficTableId').DataTable().ajax.reload();
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
            $('#trafficTableId').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('traffic.index') }}",
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
                        data: 'clicked_id',
                        name: 'clicked_id'
                    },
                    {
                        data: 'campaign_name',
                        name: 'campaign_name'
                    },
                    {
                        data: 'service_name',
                        name: 'service_name'
                    },
                    {
                        data: 'operator_name',
                        name: 'operator_name'
                    },
                    {
                        data: function(row) {
                            if (row.post_back_received == 'success') {
                                return "<span class='badge bg-gradient-success'>" + row.post_back_received +
                                    "</span>";
                            } else {
                                return "<span class='badge bg-gradient-primary'>" + row.post_back_received +
                                    "</span>";
                            }
                        },
                        name: 'post_back_received'
                    },
                    {
                        data: function(row) {
                            if (row.post_back_sent == 'success') {
                                return "<span class='badge bg-gradient-success'>" + row.post_back_sent +
                                    "</span>";
                            } else {
                                return "<span class='badge bg-gradient-primary'>" + row.post_back_sent +
                                    "</span>";
                            }
                        },
                        name: 'post_back_sent'
                    },
                    {
                        data: function(row) {
                            return `
                            <div class="mt-2 btn-group"  role="group" aria-label="Basic outlined example">
                                 <button class="px-3 btn btn-sm bg-gradient-danger trafficDeleteBtn" data-id="${row.id}" type="button" data-bs-toggle="tooltip"
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
                    }
                ]
            });

            $('.input-sm').addClass('form-control form-control-sm');
            $('#trafficTableId_filter').addClass('px-5');
        };
    </script>
@endpush
