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
            Campaigns Reports
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="w-full mx-auto mb-5">
    <h2 class="text-3xl font-bold text-gray-700">Campaign's Report</h2>
</div>
<div class="w-10/12 mx-auto card">
    <div class="px-4 mt-3 mb-1 row">
            <h6>Campaign's Report List</h6>
            <div class="col-md-3">
                    <label for="report_campaign_id" class="required">Campaign Selection</label>
                    <select class="form-control" required name="report_campaign_id" id="report_campaign_id">
                        <option disabled selected value="">
                            Select a campaign
                        </option>
                        @foreach ($campaigns as $campaign)
                            <option  value="{{ $campaign->id }}">
                                {{ $campaign->name }}
                            </option>                        
                        @endforeach
    
                    </select>
            </div>
            <div class="col-md-3">
                    <label for="report_campaign_start_date" class="required">Start Date</label>
                    <input type="date" class="form-control" value="2023-08-10" id="report_campaign_start_date" required>
            </div>
            <div class="col-md-3">
                    <label for="report_campaign_end_date" class="optional">End Date</label>
                    <input type="date" class="form-control" value="2023-08-15" id="report_campaign_end_date">
            </div> 
            <div class="col-md-3">
                <label for="report_campaign_operator" class="required">Operator Selection</label>
                <select class="form-control" required id="report_campaign_operator">
                    <option  disabled selected value="">
                        Select a operator
                    </option>
                    @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}">
                        {{ $operator->name }}
                    </option>                        
                @endforeach
                </select>
            </div>
            <div class="flex justify-between my-4 col-md-12">
                <div class="">
                    <h2 class="text-base text-gray-500 font-semibold hidden">
                        Campaign Name : <span class="text-gray-600 font-bold" id="setCampaignName"></span>
                    </h2>
                    <h2 class="text-base text-gray-500 font-semibold hidden">
                        Operator Name : <span class="text-gray-600 font-bold" id="setOperatorName"></span>
                    </h2>
                </div>
                <button class="btn bg-gradient-primary campaignReportSearchBtn" id="search">
                    Search
                </button>
            </div>
    </div>
    <div class="table-responsive">
        <table class="table px-2 pb-3 mb-0 align-items-center" id="campaignReportTableId">
            <thead>
                <tr>
                    <th class="text-center align-middle text-uppercase text-secondary text-xs font-weight-bolder opacity-9">#</th>
                    <th class="text-center align-middle text-uppercase text-secondary text-xs font-weight-bolder opacity-9">
                        Date
                    </th>
                    <th class="text-center align-middle text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">
                        Traffic Received
                    </th>
                    <th class="text-center align-middle text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">
                        Postback Sent
                    </th>
                    <th class="text-center align-middle text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2">
                        Postback Received
                    </th>
                </tr>
            </thead>
            <tbody class="campaignReportTableBody">
                <tr>
                    <td class="text-center align-middle" colspan="6">
                        <p class="mb-0 text-base font-bold text-[#E00991]">
                            Please select a campaign and operator to view the report
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

