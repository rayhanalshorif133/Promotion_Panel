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
                <a href="{{ route('campaign.index') }}" class="px-3 btn btn-sm bg-gradient-danger" type="button"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Campaign's List">
                    <i class="fa-solid fa-arrow-left fa-beat"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="w-10/12 mx-auto card pb-4 pt-2 my-2">
        <div class="p-3 pb-0 card-header">
            <h5 class="mb-2">Campaign Basic Information</h5>
            <div class="w-full h-[1px] bg-gray-200"></div>
        </div>
        <div class="p-3 card-body row">
            <div class="col-md-3 py-2 md:py-0">
                <span class="mr-1 font-semibold text-gray-500">Campaign Name:</span>
                <span>{{ $campaign->name }}</span>
            </div>
            <div class="col-md-3 py-2 md:py-0">
                <span class="mr-1 font-semibold text-gray-500">Publisher Name:</span>
                <span>{{ $campaign->publisher->name }}</span>
            </div>
            <div class="col-md-3 py-2 md:py-0">
                <span class="mr-1 font-semibold text-gray-500">Ratio:</span>
                <span class="badge bg-gradient-info">{{ $campaign->ratio }}</span>
            </div>
            <div class="col-md-3 py-2 md:py-0">
                <span class="mr-1 font-semibold text-gray-500">Status:</span>
                @if ($campaign->status == 'active')
                    <span class="badge badge-sm bg-gradient-success">
                        {{ $campaign->status }}
                    </span>
                @else
                    <span class="badge badge-sm bg-gradient-danger">
                        {{ $campaign->status }}
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="card w-10/12 pb-4 pt-2 my-2 mx-auto">
        <div class="p-3 pb-0 card-header">
            <h5 class="mb-2">Campaign Details Others</h5>
            <div class="w-full h-[1px] bg-gray-200"></div>
        </div>
        <div class="col-12 px-5 hidden lg:flex lg:col-12">
            <div class="pb-5 table-responsive pt-3 lg:w-full">
                <table class="table pb-3 mb-0 align-items-start" id="campaignDetailsTableId">
                    <thead>
                        <tr>
                            <th
                                class="align-self-start text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                #</th>
                            <th
                                class="align-self-start text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">
                                Operator Name</th>
                            <th class="text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                Service Name</th>
                            <th class="text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                Campaign Url</th>
                            <th class="text-start text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($campaign->campaignDetails) > 0)
                            @foreach ($campaign->campaignDetails as $campaignDetail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $campaignDetail->operator->name }}</td>
                                    <td>{{ $campaignDetail->service->name }}</td>
                                    <td>{{ $campaignDetail->url }}</td>
                                    <td>
                                        <div class="rounded-full cursor-pointer w-10 campaignUrlCopyBtn"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"
                                            data-url="{{ $campaignDetail->url }}">
                                            <i
                                                class="p-2 text-gray-800 border-[1px] border-gray-800 rounded-full hover:text-gray-100 hover:bg-gray-800 fa-solid fa-copy"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex lg:hidden sm:px-5 px-[1px] py-2 overflow-hidden">
            <div class="row">
                @if (count($campaign->campaignDetails) > 0)
                    @foreach ($campaign->campaignDetails as $campaignDetail)
                        <div class="col-md-6 overflow-hidden">
                            <div class="p-[1rem] sm:p-4 m-3 mx-2 sm:mx-0 shadow-sm shadow-slate-400 bg-gray-100">
                                <h2 class="text-base font-semibold text-gray-600"># <span
                                        class="text-base font-normal text-gray-500">{{ $loop->iteration }}</span></h2>
                                <h2 class="text-base font-semibold text-gray-600">Operator Name: <span
                                        class="text-base font-normal text-gray-500">{{ $campaignDetail->operator->name }}</span>
                                </h2>
                                <h2 class="text-base font-semibold text-gray-600">Service Name: <span
                                        class="text-base font-normal text-gray-500">{{ $campaignDetail->service->name }}</span>
                                </h2>
                                <h2 class="text-base font-semibold text-gray-600">Campaign Url: <br />
                                    <span
                                        class="text-base font-normal text-gray-500 overflow-hidden">{{ $campaignDetail->url }}</span>
                                </h2>
                                <div class="rounded-full cursor-pointer w-10 campaignUrlCopyBtn" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Copy to clipboard"
                                    data-url="{{ $campaignDetail->url }}">
                                    <i
                                        class="p-2 text-gray-800 border-[1px] border-gray-800 rounded-full hover:text-gray-100 hover:bg-gray-800 fa-solid fa-copy"></i>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#campaignDetailsTableId").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endpush
