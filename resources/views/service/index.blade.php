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
            Service's List
        </li>
    </ol>
</nav>
@endsection

@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Service</h2>
    </div>

    <div class="w-full px-[2rem] mx-auto card">
        <div class="flex flex-col justify-between px-4 my-4 sm:flex-row">
            <h6 class="text-xl">Service's List</h6>
            <button class="mt-[5px] btn bg-gradient-primary btn-sm sm:mt-0" data-bs-toggle="modal" data-bs-target="#createService">
                Add Service
            </button>
        </div>
        <div class="w-full pb-5 table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="serviceTableId">
                <thead>
                    <tr>
                        <th> #</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Traffic URL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>
                                @if ($service->type == 'daily')
                                    <span class="badge badge-sm bg-gradient-warning">
                                        {{ $service->type }}
                                    </span>
                                @else
                                    <span class="badge badge-sm bg-gradient-info">
                                        {{ $service->type }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="mb-0 text-xs font-weight-bold">{{ $service->traffic_redirect_url }}</p>
                            </td>
                            <td>
                                @if ($service->status == 'active')
                                    <span class="badge badge-sm bg-gradient-success">
                                        {{ $service->status }}
                                    </span>
                                @else
                                    <span class="badge badge-sm bg-gradient-danger">
                                        {{ $service->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @include('service.actionBtns', ['id' => $service->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('service.createAndUpdate')
@endsection

@push('scripts')
<script>
    $(function(){
        $('#serviceTableId').DataTable({
            responsive: true,
        });
        $('.input-sm').addClass('form-control form-control-sm');
        $('#serviceTableId_filter').addClass('px-5');
    });
</script>
@endpush
