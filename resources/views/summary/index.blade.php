@extends('layouts.app')


@section('head')
    <style>
        table {
            font-size: 12px;
            color: #000000 !important;
        }

        .table thead {
            /* background-image:linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); */
            background-image: linear-gradient(310deg, #7928CA 0%, rgb(47, 114, 114) 100%);
            color: #ffffff !important;
        }

        .table thead .operator th {
            padding: 2px !important;
            width: 5px !important;
            color: #000000 !important;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: rgb(213 212 212) !important;
            color: #2b2c2f !important;
        }

        .text-bold {
            font-weight: bold !important;
        }

        .overflow-hidden {
            overflow-x: auto;
        }

        .overflow-x-scroll {
            overflow-x: scroll;
        }
    </style>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
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
    <div class="w-full mx-auto mb-1">
        <h2 class="text-3xl font-bold text-gray-700">Campaign's Report</h2>
    </div>
    <div class="w-full px-1 mx-auto card">
        <form action="{{ route('summary.index') }}" method="get">
            {{-- @csrf --}}
            <div class="mt-3 mb-1 row">
                <h6 class="text-xl">Campaign's Report List</h6>
                <div class="col-md-3">
                    <label for="report_campaign_id" class="optional">Publisher Selection</label>
                    <select class="form-control" name="publisher_id">
                        <option disabled selected value="">
                            Select a Publisher
                        </option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}" @if ($publisher_id == $publisher->id) selected @endif>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="report_campaign_id" class="optional">Operator Selection</label>
                    <select class="form-control" name="operator_id">
                        <option disabled selected value="">
                            Select a Operator
                        </option>
                        @foreach ($operators as $operator)
                            <option value="{{ $operator->id }}" @if ($operator_id == $operator->id) selected @endif>
                                {{ $operator->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="report_campaign_id" class="optional">Service Selection</label>
                    <select class="form-control" name="service_id">
                        <option disabled selected value="">
                            Select a service
                        </option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @if ($service_id == $service->id) selected @endif>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date" class="optional">Start Date</label>
                    <input type="date" class="form-control" name="start_date"
                        @if ($start_date) value="{{ $start_date }}" @endif id="start_date">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="optional">End Date</label>
                    <input type="date" class="form-control" id="end_date"
                        @if ($end_date) value="{{ $end_date }}" @endif name="end_date">
                </div>
                <div class="mt-3 text-center col-md-3">
                    <button type="submit" class="mt-1 btn bg-gradient-primary campaignReportSearchBtn" id="search">
                        Search
                    </button>
                    <a href="{{ route('summary.index') }}" class="mt-1 btn bg-gradient-danger" id="reset">
                        Reset
                    </a>
                </div>
            </div>
        </form>
        <div class="overflow-x-scroll" style="width: 100%;">
            <div class="text-left">
                <button class="btn bg-gradient-primary" onclick="ExportToExcel()">Export to Excel</button>
            </div>
            <table class="table table-bordered table-striped" id="campaignReportTableId">
                <thead>
                    <tr>
                        <th width="auto" class="text-center">Date</th>
                        <th width="auto" class="text-center">Publisher</th>
                        <th width="auto" class="text-center">Operator</th>
                        <th width="auto" class="text-center">Traffic <br /> Received </th>
                        <th width="auto" class="text-center">Postback <br /> Received </th>
                        <th width="auto" class="text-center">Postback <br /> Sent</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalTraffic = 0;
                        $totalPostbackRec = 0;
                        $totalPostbackSent = 0;
                    @endphp
                    @foreach ($promotionSummaries as $promotionSummary)
                        <tr>
                            <td class="text-center">{{ date('d/m/Y', strtotime($promotionSummary->operation_date)) }}</td>
                            <td class="text-center">{{ $promotionSummary->publisher->name }}</td>
                            <td class="text-center">{{ $promotionSummary->operator->name }}</td>
                            <td class="text-center">{{ $promotionSummary->total_traffic }}</td>
                            <td class="text-center">{{ $promotionSummary->postback_rec }}</td>
                            <td class="text-center">{{ $promotionSummary->postback_sent }}</td>
                        </tr>
                        @php
                            $totalTraffic += $promotionSummary->total_traffic;
                            $totalPostbackRec += $promotionSummary->postback_rec;
                            $totalPostbackSent += $promotionSummary->postback_sent;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-info">
                        <th colspan="3" class="text-right text-bold">Total</th>
                        @if ($promotionSummaries->count())
                            <th class="text-center text-bold"> {{ $totalTraffic }}</th>
                            <th class="text-center text-bold">{{ $totalPostbackRec }}</th>
                            <th class="text-center text-bold">{{ $totalPostbackSent }}</th>
                        @else
                            <th class="text-center text-bold">0</th>
                            <th class="text-center text-bold">0</th>
                            <th class="text-center text-bold">0</th>
                        @endif
                    </tr>
                </tfoot>
            </table>
        </div>
        {{-- design --}}
    </div>
@endsection

@push('scripts')
    <script>
        function ExportToExcel() {
            var htmltable = document.getElementById('campaignReportTableId');
            var html = htmltable.outerHTML;
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
        }
    </script>
@endpush
