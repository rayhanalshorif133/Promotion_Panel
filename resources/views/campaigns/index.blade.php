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
                Campaigns List
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
            <h6>Campaign's List</h6>
            <a href="{{ route('campaign.create') }}" class="btn bg-gradient-primary">
                Add Campaign
            </a>
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
                            Name</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $loop->index + 1 }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $campaign->name }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $campaign->publisher->name }}</p>
                            </td>
                            <td class="text-sm text-center align-middle">
                                @if ($campaign->campaignDetail)
                                    @if ($campaign->campaignDetail->status == 'active')
                                        <span class="badge badge-sm bg-gradient-success">
                                            {{ $campaign->campaignDetail->status }}
                                        </span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">
                                            {{ $campaign->campaignDetail->status }}
                                        </span>
                                    @endif
                                @else
                                    <span class="badge badge-sm bg-gradient-danger">
                                        Not Active
                                    </span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @include('campaigns.actionBtns', ['id' => $campaign->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
