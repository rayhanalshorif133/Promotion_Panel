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

    <div class="w-8/12 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6>Traffic's List</h6>
        </div>
        <div class="table-responsive">
            <table class="table px-2 pb-3 mb-0 align-items-center">
                <thead>
                    <tr>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            #</th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Clicked Id</th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Campaign Name</th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Service Name
                        </th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Operator Name
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($traffics as $traffic)
                        <tr>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $loop->index + 1 }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $traffic->clicked_id }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('campaign.show', $traffic->campaign->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Campaign Details" class="mb-0 text-xs text-blue-600 font-weight-bold">{{ $traffic->campaign->name }}</a>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $traffic->service->name }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $traffic->operator->name }}</p>
                            </td>

                            <td class="text-center align-middle">
                                @include('traffic.actionBtns', ['id' => $traffic->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-2">
            <h1 class="text-sm font-semibold">
                <span class="font-bold mr-2">Note:</span> <br>
                <span class="font-semibold mr-2">Post Back URL:</span>
                <span class="text-blue-600">//{base_url}/traffic/post-back/{serviceId}/{channel}/{operatorName}/{clickedID}/?...</span>
            </h1>
        </div>
    </div>
    @include('traffic.show')
@endsection

@push('scripts')
@endpush
