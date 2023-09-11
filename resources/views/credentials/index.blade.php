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
                Credential's List
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Credentials </h2>
    </div>

    <div class="w-full px-[2rem] mx-auto lg:px-1 card">
        <div class="flex flex-col justify-between px-4 my-4 sm:flex-row">
            <h6 class="text-xl">Credential's List</h6>
            <a href="{{ route('credentials.create') }}" class="mt-[5px] btn bg-gradient-primary btn-sm sm:mt-0">
                Add Credential
            </a>
        </div>
        <div class="w-full pb-5 table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="credentialTableId">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Password</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($credentials as $credential)
                        <tr>
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td class="">{{ $credential->title }}</td>
                            <td class="">
                                <div class="flex" id="{{ $credential->id }}">
                                    <span class="mx-1">*******</span>
                                    <i class="mx-2 mt-1 cursor-pointer fa-solid fa-eye-slash showPass"></i>
                                    <i class="mx-2 mt-1 cursor-pointer d-none fa-solid fa-eye hidePass"></i>
                                </div>
                            </td>
                            <td class="">{!! $credential->details !!}</td>
                            <td class="">
                                <div class="mt-2 btn-group" role="group" aria-label="Basic outlined example">
                                    <button class="px-3 btn btn-sm bg-gradient-primary" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Show info">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <a href="{{route('credentials.edit', $credential->id)}}" class="px-3 btn btn-sm bg-gradient-info" type="button" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit item">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <button id="credential_{{ $credential->id }}"
                                        class="px-3 btn btn-sm bg-gradient-danger deleteCredentialBtn" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Remove item">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(function() {
            $('#credentialTableId').DataTable({
                responsive: true,
            });
            $('.input-sm').addClass('form-control form-control-sm');
            $('#credentialTableId_filter').addClass('px-5');
            $('#details').summernote();

            $(".showPass").click(function() {
                var id = $(this).parent().attr('id');
                $(".hidePass").removeClass('d-none');
                $(".showPass").addClass('d-none');
                axios.get(`credentials/get-password/${id}`)
                    .then(function(response) {
                        $(`#${id}`).find('span').text(response.data.data);
                    });
            });

            $(".hidePass").click(function() {
                var id = $(this).parent().attr('id');
                $(`#${id}`).find('span').text('*******');
                $(".hidePass").addClass('d-none');
                $(".showPass").removeClass('d-none');
            });

            $(".deleteCredentialBtn").click(function() {
                var id = $(this).attr('id').split('_')[1];
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
                        axios.delete(`/credentials/delete/${id}`)
                            .then(function(response) {
                                console.log();
                                if(response.data.status == true){
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                }else{
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong.',
                                        'error'
                                    );
                                }
                            });
                    }
                })
            });
        });
    </script>
@endpush
