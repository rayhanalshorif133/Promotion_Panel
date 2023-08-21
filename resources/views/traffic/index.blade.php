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

    <div class="w-8/12 px-5 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6 class="text-xl">Traffic's List</h6>
        </div>
        <div class="table-responsive">
            <table class="table px-2 pb-3 mb-0 align-items-center" id="trafficTableId">
                <thead>
                    <tr>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7">
                            #</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Clicked Id</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Campaign Name</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Service Name
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                            Operator Name
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-7">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="px-4 py-2">
            <h1 class="text-sm font-semibold">
                <span class="mr-2 font-bold">Note:</span> <br>
                <span class="mr-2 font-semibold">Post Back URL:</span>
                <span
                    class="text-blue-600">//{base_url}/traffic/post-back/{serviceId}/{channel}/{operatorName}/{clickedID}/?...</span>
            </h1>
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
        };
    </script>
@endpush
