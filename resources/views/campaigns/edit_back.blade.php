@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="text-sm breadcrumb-item"><a class="opacity-5 text-dark" href="{{ route('campaign.index') }}">
                    Campaign's List
                </a></li>
            <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                Update Campaign
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
            <h6>
                Update Campaign
            </h6>
            <a href="{{ route('campaign.index') }}" class="px-3 btn bg-gradient-danger btn-sm">
                <i class="px-2 fa-solid fa-arrow-left fa-beat"></i> Back to Campaign's List
            </a>
        </div>
        <form action="{{ route('campaign.update') }}" method="POST">
            @csrf
            <div class="px-5 row">
                <div class="col-md-6">
                    <h5 class="text-lg">Campaign Basic Info</h5>
                    <input type="hidden" name="id" value="{{ $campaign->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="required">Campaign Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Campaign name" value="{{$campaign->name}}">
                        </div>
                        <div class="form-group">
                            <label for="publisher" class="required">Select publisher</label>
                            <select class="form-control" required name="publisher_id" id="publisher">
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" @if ($publisher->id == $campaign->publisher->id)
                                        selected
                                    @endif>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="text-lg">Campaign Details Info</h5>
                    <div class="form-group">
                        <label for="operator" class="required">Select Operator</label>
                        <select class="form-control" required name="operator_id" id="operator">
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->id }}" @if ($operator->id == $campaign->campaignDetail->operator->id)
                                    selected
                                @endif>
                                    {{ $operator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service" class="required">Select service</label>
                        <select class="form-control" required name="service_id" id="service">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @if ($service->id == $campaign->campaignDetail->service->id)
                                    selected
                                @endif>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ratio" class="required">Ratio</label>
                        <input type="number" class="form-control" required id="campaign_create_ratio" name="ratio"
                            placeholder="Ratio" value="{{$campaign->campaignDetail->ratio}}" min="0" max="1" step="any">
                        <label for="ratio" class="text-danger" id="ratioErrorMsg"></label>
                    </div>
                    <div class="form-group">
                        <label for="url" class="required">url</label>
                        <input type="text" class="form-control" required id="url" name="url"
                            placeholder="url" value="{{$campaign->campaignDetail->url}}" >  
                    </div>
                    <div class="-mt-4 form-group">
                        <label for="status" class="required">Select status</label>
                        <select class="form-control" required name="status" id="status">

                            <option @if ($campaign->campaignDetail->status == 'active') selected  @endif value="active">Active</option>
                            <option @if ($campaign->campaignDetail->status == 'inactive') selected  @endif value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="float-right mx-auto">
                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
