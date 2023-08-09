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
            <div>
                <a href="{{ route('campaign.edit', $campaign->id) }}"
                    class="px-3 btn btn-sm bg-gradient-info campaignEditBtn" type="button" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Edit item">
                    <i class="fa fa-pen"></i>
                </a>
                <a href="{{ route('campaign.index') }}"
                    class="px-3 btn btn-sm bg-gradient-danger" type="button" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Back to Campaign's List">
                    <i class="fa-solid fa-arrow-left fa-beat"></i>
                </a>
            </div>
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
                    <ul class="list-group">
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Campaign Name:</span>
                            <span>{{ $campaign->name }}</span>
                        </li>
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Publisher Name:</span>
                            <span>{{ $campaign->publisher->name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="px-3 col-12 col-xl-8">
            <div class="card h-100">
                <div class="p-3 pb-0 card-header">
                    <h5 class="mb-2">Campaign Details Information</h5>
                    <div class="w-full h-[1px] bg-gray-200"></div>
                </div>
                <div class="p-3 card-body">
                    <ul class="list-group">
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Operator Name:</span>
                            <span> {{ $campaign->campaignDetail->operator->name }}</span>
                        </li>
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Service Name:</span>
                            <span>{{ $campaign->campaignDetail->service->name }}</span>
                        </li>
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Ratio:</span>
                            <span class="badge bg-gradient-info">{{ $campaign->campaignDetail->ratio }}</span>
                        </li>

                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Campaign URL:</span> <br>
                            <div class="mt-2 text-white alert alert-secondary" role="alert">
                                {{ $campaign->campaignDetail->url }}
                                <strong class="absolute right-5">
                                    <div class="bg-gray-400 rounded-full cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Copy to clipboard"
                                        data-url="{{ $campaign->campaignDetail->url }}" id="campaignUrlCopyBtn">
                                        <i
                                            class="p-2 text-gray-800 rounded-full hover:text-white hover:bg-gray-800 fa-solid fa-copy"></i>
                                    </div>
                                </strong>
                            </div>
                        </li>
                        <li class="px-0 border-0 list-group-item test-base">
                            <span class="mr-1 font-semibold text-gray-500">Status:</span>
                            @if ($campaign->campaignDetail->status == 'active')
                                <span class="badge badge-sm bg-gradient-success">
                                    {{ $campaign->campaignDetail->status }}
                                </span>
                            @else
                                <span class="badge badge-sm bg-gradient-danger">
                                    {{ $campaign->campaignDetail->status }}
                                </span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
