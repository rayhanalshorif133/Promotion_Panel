@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
        <li class="text-sm breadcrumb-item">
            <a class="opacity-3 text-dark" href="{{route('dashboard')}}">
                <i class="fa-solid fa-house"></i>
            </a>
        </li>
        <li class="text-sm breadcrumb-item"><a class="opacity-5 text-dark" href="{{route('campaign.index')}}">
            Campaign's List
        </a></li>
        <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
            Create Campaign
        </li>
    </ol>
</nav>

@endsection
@section('content')
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">Campaigns</h2>
    </div>
    <div class="w-10/12 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6>
                Create a new Campaign
            </h6>
            <a href="{{route('campaign.index')}}" class="px-3 btn bg-gradient-danger btn-sm">
                <i class="px-2 fa-solid fa-arrow-left fa-beat"></i> Back to Campaign's List
            </a>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
