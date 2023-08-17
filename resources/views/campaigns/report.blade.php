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
    <div class="flex justify-between px-4 mb-1">
        <h6 class="mt-[2.5rem]">Campaign's Report List</h6>
        <div class="flex justify-between mt-2 form-group">
            <div class="mx-4">
                <label for="campaign">Select a Campaign</label>
                <select class="form-control" required name="campaign_id" id="campaign">
                    <option selected disabled value="">
                        Select a campaign
                    </option>
                    @foreach ($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">
                            {{ $campaign->name }}
                        </option>                        
                    @endforeach

                </select>
            </div>
            <div class="mx-4">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" required>
            </div>
            <div class="mx-4">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" required>
            </div>
            <div class="mx-4">
                <label for="operator">Operator</label>
                <select class="form-control" required name="operator_id" id="operator">
                    <option selected disabled value="">
                        Select a operator
                    </option>
                </select>
            </div>
            <div class="mx-4 mt-[1.9rem]">
                <button class="btn bg-gradient-primary" id="search">
                    Search
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table px-2 pb-3 mb-0 align-items-center">
            <thead>
                <tr>
                    <th class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                    <th class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
@endpush
