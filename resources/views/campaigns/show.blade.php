@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="text-sm breadcrumb-item">
                <a class="opacity-5 text-dark" href="{{ route('campaign.index') }}">
                    Campaign's List
                </a>
            </li>
            <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                {{ $campaign->name }}
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">Campaigns</h2>
    </div>
    <div class="w-10/12 mx-auto card">
        <div class="flex justify-between px-4 pb-0 mt-4 mb-2">
            <h4>
                Campaign Details
            </h4>
            <a href="{{ route('campaign.index') }}" class="px-3 btn bg-gradient-warning btn-sm">
                <i class="px-2 fa-solid fa-arrow-left fa-beat"></i> Back to Campaign's List
            </a>
        </div>
    </div>
    <div class="w-10/12 py-5 mx-auto row">
        <div class="px-3 col-12 col-xl-4">
            <div class="card h-100">
                <div class="p-3 pb-0 card-header">
                    <h5 class="mb-2">Campaign Basic Information</h5>
                    <div class="w-full h-[1px] bg-gray-200"></div>
                </div>
                <div class="p-3 card-body">
                    <h6 class="text-xs text-uppercase text-body font-weight-bolder">Account</h6>
                    <ul class="list-group">
                        <li class="px-0 border-0 list-group-item">
                            Helo
                        </li>
                    </ul>
                    <h6 class="mt-4 text-xs text-uppercase text-body font-weight-bolder">Application</h6>
                    <ul class="list-group">
                        <li class="px-0 border-0 list-group-item">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                                <label class="mb-0 form-check-label text-body ms-3 text-truncate w-80"
                                    for="flexSwitchCheckDefault3">New launches and projects</label>
                            </div>
                        </li>
                        <li class="px-0 border-0 list-group-item">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4"
                                    checked="">
                                <label class="mb-0 form-check-label text-body ms-3 text-truncate w-80"
                                    for="flexSwitchCheckDefault4">Monthly product updates</label>
                            </div>
                        </li>
                        <li class="px-0 pb-0 border-0 list-group-item">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                                <label class="mb-0 form-check-label text-body ms-3 text-truncate w-80"
                                    for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
