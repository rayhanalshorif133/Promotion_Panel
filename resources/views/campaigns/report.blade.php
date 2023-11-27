@extends('layouts.app')


@section('head')
<style>
    table{
        font-size:12px;
        color:#000000!important;
    }
    
    .table thead .operator th{
        padding: 2px !important;
        width:5px!important;
        color:#000000!important;
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
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">Campaign's Report</h2>
    </div>
    <div class="w-full px-1 mx-auto card">
        <div class="mt-3 mb-1 row">
            <h6 class="text-xl">Campaign's Report List</h6>
            <div class="col-md-3">
                <label for="report_campaign_id" class="required">Campaign Selection</label>
                <select class="form-control" required name="report_campaign_id" id="report_campaign_id">
                    <option disabled selected value="">
                        Select a campaign
                    </option>
                    @foreach ($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">
                            {{ $campaign->name }}
                        </option>
                    @endforeach
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="report_campaign_start_date" class="required">Start Date</label>
                <input type="date" class="form-control" id="report_campaign_start_date" required>
            </div>
            <div class="col-md-3">
                <label for="report_campaign_end_date" class="optional">End Date</label>
                <input type="date" class="form-control" id="report_campaign_end_date">
            </div>
            <div class="my-4 text-center col-md-3">
                <button class="mt-1 btn bg-gradient-primary campaignReportSearchBtn" id="search">
                    Search
                </button>
                <button class="mt-1 btn bg-gradient-danger" id="reset">
                    Reset
                </button>
            </div>
            <div class="py-0 my-0 col-md-12">
                <h2 class="hidden text-base font-semibold text-gray-500">
                    Campaign Name : <span class="font-bold text-gray-600" id="setCampaignName"></span>
                </h2>
            </div>
        </div>
        <div class="pb-5 mx-auto text-center align-middle campaignReportLoading">
            <p class="mb-0 text-base font-bold text-[#E00991]">
                Please select a campaign and date to view the report
            </p>
        </div>

        {{-- design --}}

        

        <table class="table table-bordered table-striped" id="campaignReportTableId">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">Date</th>
                    <th rowspan="2" width="2%">Campaign</th>
                    <th rowspan="2" width="2%">Operator</th>
                    <th width="auto" class="text-center" width="20%">Traffic <br/> Received </th>
                    <th width="auto" class="text-center" width="20%">Postback <br/> Received </th>
                    <th width="auto" class="text-center" width="20%">Postback <br/> Sent</th>
                </tr>
            </thead>
            <tbody class="campain_details_tbody">
                <tr>
                    <td rowspan="7" class="text-center">
                        10/20/2020
                    </td>
                    <td rowspan="7" class="text-center">
                        Marvel
                    </td>
                </tr>
                @foreach ($operators as $key => $operator)
                    <tr>
                        <td class="text-center">{{ $operator->name }}</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                    </tr>
                @endforeach 
                <tr>
                    <td rowspan="7" class="text-center">
                        10/20/2020
                    </td>
                    <td rowspan="7" class="text-center">
                        Marvel
                    </td>
                </tr>
                @foreach ($operators as $key => $operator)
                    <tr>
                        <td class="text-center">{{ $operator->name }}</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                    </tr>
                @endforeach 
                <tr>
                    <td rowspan="7" class="text-center">
                        10/20/2020
                    </td>
                    <td rowspan="7" class="text-center">
                        Marvel
                    </td>
                </tr>
                @foreach ($operators as $key => $operator)
                    <tr>
                        <td class="text-center">{{ $operator->name }}</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                        <td class="text-center">10</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        {{-- design --}}
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            handleCampaignReportSearch();
            handleCampaignReportReset();
        });


        const handleCampaignReportReset = () => {
            $("#reset").click(function() {
                $("#report_campaign_id").val('').trigger('change');
                $("#report_campaign_start_date").val('');
                $("#report_campaign_end_date").val('');
                $("#setCampaignName").parent().addClass('hidden');
                $("#setOperatorName").parent().addClass('hidden');
                $("#campaignReportTableId").DataTable().destroy();
                $("#campaignReportTableId tbody").html('');
                $(".campaignReportLoading").html('');
                $(".campaignReportLoading").html(
                    '<p class="mb-0 text-base font-bold text-[#E00991]">Please select a campaign and operator to view the report</p>'
                );
            });
        };
        const handleCampaignReportSearch = () => {
            $(".campaignReportSearchBtn").click(function() {
                const campaign_id = $("#report_campaign_id").val();
                const campaignName = $("#report_campaign_id").find(":selected").text().trim();
                const start_date = $("#report_campaign_start_date").val();
                var end_date = $("#report_campaign_end_date").val();
                const today = moment().format('YYYY-MM-DD');
                $("#setCampaignName").parent().removeClass('hidden');
                $("#setOperatorName").parent().removeClass('hidden');
                $("#setCampaignName").text(campaignName);


                if (!campaign_id || !start_date) {
                    toastr.error('campaign name, start date and end date are required');
                    return false;
                }

                if (!end_date) {
                    end_date = $("#report_campaign_start_date").val();
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

                var table = $(".campain_details_tbody");
                const url = `/campaign/fetch-report/${campaign_id}/${start_date}/${end_date}`;
                axios.get(url)
                .then((res)=>{
                    const data = res.data.data;
                    // console.log(data);
                    const operators = data.operators;
                    const reports = data.reports;
                    // moment().format('YYYY-MM-DD')
                    table.html('');
                    var html = "";


                    reports.map((item) =>{
                        var campaings = '';
                        const trafficReceiveds = item.traffic_received;
                        item.campaings.map((campaing) => {
                            campaings += `<span>${campaing.name} <br/></span>`;
                        });
                        
                        

                        html += `<tr>
                            <td rowspan="7" class="text-center">
                                ${item.date}
                                </td>
                                <td rowspan="7" class="text-center">
                                    ${campaings}
                                </td>
                        </tr>`;
                        var operatorHtml = "";
                        operators.map((item) =>{

                               const name =  trafficReceiveds.find((trs) => {
                                    return 2020;
                                });

                                console.log(name);
                                

                                operatorHtml += `
                                <tr>
                                     <td class="text-center">${item.name}</td>
                                     <td class="text-center">${name}</td>
                                     <td class="text-center">30</td>
                                     <td class="text-center">10</td>
                                 </tr>
                                `;
                            });
                            html +=operatorHtml
                        });
                        table.html(html);
                    });

                    



                    
                

                

                $(".campaignReportLoading").html('');
                $('.input-sm').addClass('form-control form-control-sm');
                $('#campaignReportTableId_filter').addClass('px-5');
            });
        };
    </script>
@endpush
