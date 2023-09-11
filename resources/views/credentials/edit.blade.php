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
            Update Credential
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="px-2 card">
    <div class="card-header">
        <h5 class="card-title" id="createCredentialLabel">
            Update Credential
        </h5>
    </div>
    <form action="{{ route('credentials.update',$credential->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="required">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="title" value="{{$credential->title}}">
            </div>
            <div class="form-group">
                <label for="password" class="required">Password</label>
                <input type="text" class="form-control" id="password" name="password"
                    placeholder="password" value="{{$decrypted}}">
            </div> 
            <div class="form-group">
                <label for="details" class="required">Details</label>
                <textarea id="details" class="form-control"  name="details">{!!$credential->details!!}</textarea>                            
            </div>    
        </div>
        <div class="flex justify-start px-2 ml-auto card-footer text-start">
            <a href="{{route('credentials.index')}}" type="button" class="mx-2 btn bg-gradient-secondary">Back</a>
            <button type="submit" class="mx-2 btn bg-gradient-primary">Save</button>
        </div>
    </form>
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
