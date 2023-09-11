@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
        <li class="text-sm breadcrumb-item">
            <a class="opacity-3 text-dark" href="{{route('dashboard')}}">
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
            <a href="{{route('credentials.create')}}" class="mt-[5px] btn bg-gradient-primary btn-sm sm:mt-0">
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
                </tbody>
            </table>
        </div>
    </div>
    @include('credentials.createAndUpdate')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(function(){
        $('#serviceTableId').DataTable({
            responsive: true,
        });
        $('.input-sm').addClass('form-control form-control-sm');
        $('#serviceTableId_filter').addClass('px-5');
        $('#details').summernote();
    });
    
</script>
@endpush
