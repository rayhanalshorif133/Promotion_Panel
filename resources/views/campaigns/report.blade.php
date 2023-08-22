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
                Campaigns Reports
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">Campaign's Report</h2>
    </div>
    <div class="w-full px-5 mx-auto card">
        <div class="mt-3 mb-1 row">
            <h6 class="text-xl">Campaign's Report List</h6>
            <div class="col-md-3">
                <label for="report_campaign_id" class="required">Campaign Selection</label>
                <select class="form-control" required name="report_campaign_id" id="report_campaign_id">
                    <option disabled selected value="">
                        Select a campaign
                    </option>
                    @foreach ($campaigns as $campaign)
                        <option value="{{ $campaign->id }}" selected>
                            {{ $campaign->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="report_campaign_start_date" class="required">Start Date</label>
                <input type="date" class="form-control" value="2023-08-20" id="report_campaign_start_date" required>
            </div>
            <div class="col-md-3">
                <label for="report_campaign_end_date" class="optional">End Date</label>
                <input type="date" class="form-control" value="2023-08-24" id="report_campaign_end_date">
            </div>
            <div class="col-md-3 my-4 text-center">
                <button class="btn bg-gradient-primary campaignReportSearchBtn mt-1" id="search">
                    Search
                </button>
            </div>
            <div class="my-0 py-0 col-md-12">
                <h2 class="hidden text-base font-semibold text-gray-500">
                    Campaign Name : <span class="font-bold text-gray-600" id="setCampaignName"></span>
                </h2>
            </div>
        </div>
        <div class="pb-5 mx-auto text-center align-middle campaignReportLoading">
            <p class="mb-0 text-base font-bold text-[#E00991]">
                Please select a campaign and operator to view the report
            </p>
        </div>
        <div class="pb-5 table-responsive">
            <table class="table px-2 pb-3 mb-0 align-items-center" id="campaignReportTableId">
                <thead>
                    <tr>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9">
                            #</th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9">
                            Date
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9">
                            Service
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9 ps-2">
                            Traffic Received
                            <div class="flex py-2">
                                @foreach ($operators as $key => $operator)
                                <span class="text-xs px-[10px] text-gray-700 font-semibold @if($key == 0) border-l border-r @else border-r @endif  border-gray-400">{{$operator->name}}</span>
                                @endforeach
                            </div>
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9 ps-2">
                            Postback Sent
                            <div class="flex py-2">
                                @foreach ($operators as $key => $operator)
                                <span class="text-xs px-[10px] text-gray-700 font-semibold @if($key == 0) border-l border-r @else border-r @endif  border-gray-400">{{$operator->name}}</span>
                                @endforeach
                            </div>
                        </th>
                        <th
                            class="text-xs align-self-start text-start text-uppercase text-secondary font-weight-bolder opacity-9 ps-2">
                            Postback Received
                            <div class="flex py-2">
                                @foreach ($operators as $key => $operator)
                                <span class="text-xs px-[10px] text-gray-700 font-semibold @if($key == 0) border-l border-r @else border-r @endif  border-gray-400">{{$operator->name}}</span>
                                @endforeach
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            handleCampaignReportSearch();
        });


        const handleCampaignReportSearch = () => {
            $(".campaignReportSearchBtn").click(function() {
                const campaign_id = $("#report_campaign_id").val();
                const campaignName = $("#report_campaign_id").find(":selected").text().trim();
                const start_date = $("#report_campaign_start_date").val();
                const end_date = $("#report_campaign_end_date").val();
                const today = moment().format('YYYY-MM-DD');
                $("#setCampaignName").parent().removeClass('hidden');
                $("#setOperatorName").parent().removeClass('hidden');
                $("#setCampaignName").text(campaignName);

                if (!campaign_id || !start_date || !end_date) {
                    toastr.error('campaign name, start date and end date are required');
                    return false;
                }

                const countDays = moment(end_date).diff(moment(start_date), 'days') + 1;

                if (countDays < 0) {
                    toastr.error('End date must be greater than start date');
                    return false;
                }

                if (countDays > 365) {
                    $(".campaignReportLoading p").html('Date range must be less than 365 days');
                    toastr.error('Date range must be less than 365 days');
                    setTimeout(() => {
                        $(".campaignReportLoading p").html(
                            'Please select a campaign and operator to view the report');
                        $("#report_campaign_start_date").val(today);
                        $("#report_campaign_end_date").val(today);
                    }, 3000);
                    return false;
                }

                $("#campaignReportTableId").DataTable().destroy();

                const hasDataTable = $("#campaignReportTableId").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: `/campaign/fetch-report-data/${campaign_id}/${start_date}/${end_date}`,
                    columns: [{
                            data: function(row, type, set, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'item'
                        },
                        {
                            data: function(row) {
                                var date = moment(row?.date).format('DD-MMM-YYYY');
                                return date;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'date'
                        },
                        {
                            data: function(row) {
                                return row.service;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'service'
                        },
                        {
                            data: function(row) {
                                return row?.traffic_received;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'traffic_received'
                        },
                        {
                            data: function(row) {
                                return row?.post_back_sent;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'post_back_sent'
                        },
                        {
                            data: function(row) {
                                return row?.post_back_received;
                            },
                            searchable: false,
                            orderable: false,
                            className: "align-self-start text-start",
                            name: 'post_back_received'
                        }
                    ]
                });

                $(".campaignReportLoading").html('');
            });
        };
    </script>
@endpush
