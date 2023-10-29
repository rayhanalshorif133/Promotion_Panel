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
            <a class="opacity-3 text-dark" href="{{route('credentials.index')}}">
                Credential
            </a>
        </li>
        <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
            Credential's Details
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="w-8/12 px-2 mx-auto card">
    <div class="card-header">
        <h5 4class="card-title" id="createCredentialLabel">
            Credential's Details
            <div class="w-full my-2 bg-gray-400" style="height: 1px"></div>
        </h5>
    </div>
    <div class="card-body">
        <div class="my-1">
            <span class="mr-2 text-xl font-semibold">Title:</span><span class="mr-2 text-base font-medium">{{$credential->title}}</span>
        </div>
        <div class="my-1">
            <span class="mr-2 text-xl font-semibold">Password:</span><span class="mr-2 text-base font-medium">{{$decrypted}}</span>
        </div>
        <div class="my-1">
            <span class="mr-2 text-xl font-semibold">Details:</span>
            <p class="mr-2 text-base font-medium">{!!$credential->details!!}</p>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(function(){
        $('#details').summernote({
            height: 200,
        });
    });
    
</script>
@endpush
