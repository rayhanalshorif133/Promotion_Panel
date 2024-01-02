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
                Campaign's Summary Report
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto mb-1">
        <h2 class="text-3xl font-bold text-gray-700">Campaign's Summary Report </h2>
    </div>
    <div class="w-full px-1 mx-auto card">
        <div class="mt-3 mb-1 row px-4">
            <h6 class="text-xl">Campaign's Summary Report</h6>
            <div class="col-md-3">
                <label for="summaryreport_campaign_start_date" class="required">Start Date</label>
                <input type="date" class="form-control" id="summaryreport_campaign_start_date" required>
            </div>
            <div class="col-md-3">
                <label for="summaryreport_campaign_end_date" class="optional">End Date</label>
                <input type="date" class="form-control" id="summaryreport_campaign_end_date">
            </div>
            <div class="my-4 text-center col-md-3">
                <button class="mt-1 btn bg-gradient-primary campaignSummaryreportSearchBtn" id="search">
                    Search
                </button>
            </div>
            <div class="py-0 my-0 col-md-12">
                <h2 class="hidden text-base font-semibold text-gray-500">
                    Campaign Name : <span class="font-bold text-gray-600" id="setCampaignName"></span>
                </h2>
            </div>
        </div>

        <div class="pb-1 mx-auto text-center align-middle campaignSummaryReportLoading">
            <p class="mb-0 text-base font-bold text-[#E00991]">
                Please select a campaign and date to view the report
            </p>
        </div>




        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">Campaign</th>
                    <th width="auto" colspan="{{ $operators->count() + 1 }}" class="text-center" width="20%">Traffic
                        Received </th>
                    <th width="auto" colspan="{{ $operators->count() + 1 }}" class="text-center" width="20%">Postback
                        Received </th>
                    <th width="auto" colspan="{{ $operators->count() + 1 }}" class="text-center" width="20%">Postback
                        Sent
                    </th>
                </tr>
                <tr>
                    @foreach ($operators as $operator)
                        <th class="text-center">{{ $operator->name }}</th>
                    @endforeach
                    <th class="text-center">Count</th>
                    @foreach ($operators as $operator)
                        <th class="text-center">{{ $operator->name }}</th>
                    @endforeach
                    <th class="text-center">Count</th>
                    @foreach ($operators as $operator)
                        <th class="text-center">{{ $operator->name }}</th>
                    @endforeach
                    <th class="text-center">Count</th>
                </tr>
            </thead>
            <tbody class="summaryCampain_details_tbody">

            </tbody>
            <tfoot class="summaryCampain_details_tfoot"></tfoot>
        </table>
        {{-- design --}}
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            console.clear();
            handleCampaignReportSearch();
            handleCampaignReportReset();
        });


        const handleCampaignReportReset = () => {
            console.log('handleCampaignReportReset');
        };
        const handleCampaignReportSearch = () => {
            $(".campaignSummaryreportSearchBtn").click(function() {
                const start_date = $("#summaryreport_campaign_start_date").val();
                var end_date = $("#summaryreport_campaign_end_date").val();
                const loadingHtml = $(".campaignSummaryReportLoading");
                const today = moment().format('YYYY-MM-DD');
                const isCheck = checkAllInput(start_date, end_date, loadingHtml, today);
                if (!isCheck) {
                    return false;
                }

                var table = $(".summaryCampain_details_tbody");
                var tableFooter = $(".summaryCampain_details_tfoot");
                if (!end_date) {
                    end_date = $("#summaryreport_campaign_start_date").val();
                }
                const url = `/campaign/summary-report?start_date=${start_date}&end_date=${end_date}&fetch=true`;
                fetchData(url, table, tableFooter, loadingHtml);
            });
        };

        const fetchData = async (url, table, tableFooter, loadingHtml) => {
            await axios.get(url)
                .then((res) => {
                    const data = res.data.data;
                    const campaigns = data.campaigns;
                    const total_count = data.total_count;

                    var html = "";
                    campaigns.length > 0 && campaigns.map((campaign) => {
                        const trafficReceiveds = campaign.traffic_received;
                        const postbackReceiveds = campaign.postback_received;
                        const postbackSents = campaign.postback_sent;
                        var isHide = false;

                        var trafficReceivedsHtml = "";
                        var postbackReceivedsHtml = "";
                        var postbackSentsHtml = "";

                        var totalTrafficReceived = 0;
                        var totalPostbackReceived = 0;
                        var totalPostbackSent = 0;

                        trafficReceiveds.length > 0 && trafficReceiveds.map((trafficReceived) => {
                            const operator = trafficReceived.operator;
                            totalTrafficReceived += trafficReceived.count;
                            const trafficReceivedHtml =
                                `<td class="text-center">${trafficReceived.count}</td>`;
                            trafficReceivedsHtml += trafficReceivedHtml;
                        });

                        if(totalTrafficReceived == 0){
                            isHide = true;
                        }
                        trafficReceivedsHtml +=
                            `<td class="text-center font-bold">${totalTrafficReceived}</td>`;



                        postbackReceiveds.length > 0 && postbackReceiveds.map((postbackReceived) => {
                            const operator = postbackReceived.operator;
                            totalPostbackReceived += postbackReceived.count;
                            const postbackReceivedHtml =
                                `<td class="text-center">${postbackReceived.count}</td>`;
                            postbackReceivedsHtml += postbackReceivedHtml;
                        });

                        postbackReceivedsHtml +=
                            `<td class="text-center font-bold">${totalPostbackReceived}</td>`;

                        postbackSents.length > 0 && postbackSents.map((postbackSent) => {
                            const operator = postbackSent.operator;
                            totalPostbackSent += postbackSent.count;
                            const postbackSentHtml =
                                `<td class="text-center">${postbackSent.count}</td>`;
                            postbackSentsHtml += postbackSentHtml;
                        });

                        postbackSentsHtml +=
                            `<td class="text-center font-bold">${totalPostbackSent}</td>`;


                        if(isHide === false) {
                            var campaign_html = `<tr>
                                <td class="text-center" id="campaign_id-${campaign.id}">${campaign.name}</td>
                                ${trafficReceivedsHtml}
                                ${postbackReceivedsHtml}
                                ${postbackSentsHtml}
                            </tr>`;
                            html += campaign_html;
                        }
                    });
                    table.html(html);

                    var total_counts_html = "";
                    const traffic_received = total_count.traffic_received;
                    const postback_received = total_count.postback_received;
                    const postback_sent = total_count.postback_sent;

                    var total_traffic_received = 0;
                    var total_postback_received = 0;
                    var total_postback_sent = 0;

                    traffic_received.length > 0 && traffic_received.map((item) => {
                        total_traffic_received += item.count;
                        const total_count_html = `<td class="text-center">${item.count}</td>`;
                        total_counts_html += total_count_html;
                    });
                    total_counts_html += `<td class="text-center font-bold">${total_traffic_received}</td>`;

                    postback_received.length > 0 && postback_received.map((item) => {
                        total_postback_received += item.count;
                        const total_count_html = `<td class="text-center">${item.count}</td>`;
                        total_counts_html += total_count_html;
                    });

                    total_counts_html += `<td class="text-center font-bold">${total_postback_received}</td>`;

                    postback_sent.length > 0 && postback_sent.map((item) => {
                        total_postback_sent += item.count;
                        const total_count_html = `<td class="text-center">${item.count}</td>`;
                        total_counts_html += total_count_html;
                    });

                    total_counts_html += `<td class="text-center font-bold">${total_postback_sent}</td>`;

                    tableFooter.html(`<tr
                            class="text-center font-bold">
                            <td class="text-center">Total</td>
                            ${total_counts_html}
                        </tr>`);

                    loadingHtml.html('');

                });
        };

        const checkAllInput = (start_date, end_date, loadingHtml, today) => {
            const loading = `<div class="spinner-border text-[#E00991]" role="status">
                            <span class="visually-hidden">Loading...</span>
                    </div>`;
            loadingHtml.html(loading);
            if (!start_date) {
                toastr.error('Start date is required');
                loadingHtml.html('');
                return false;
            }




            const countDays = moment(end_date).diff(moment(start_date), 'days') + 1;

            if (countDays < 0) {
                toastr.error('End date must be greater than start date');
                loadingHtml.html('');
                return false;
            }

            if (countDays > 365) {
                $(".campaignSummaryReportLoading p").html('Date range must be less than 365 days');
                toastr.error('Date range must be less than 365 days');
                setTimeout(() => {
                    $(".campaignSummaryReportLoading p").html(
                        'Please select a campaign and operator to view the report');
                    $("#report_campaign_start_date").val(today);
                    $("#report_campaign_end_date").val(today);
                }, 3000);
                return false;
            }

            return true;
        };
    </script>
@endpush
