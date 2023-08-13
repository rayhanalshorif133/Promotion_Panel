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
            Dashboard
        </li>
    </ol>
</nav>
@endsection


@section('content')
<div class="w-full mx-auto">
    <h2 class="text-3xl font-bold text-gray-700">Sent Logs</h2>
</div>

<div class="w-8/12 mx-auto card">
    <div class="flex justify-between px-4 my-4">
        <h6>Post Back Sent Logs</h6>
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
                        Clicked Id</th>
                    <th
                        class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Service Name
                    </th>
                    <th
                        class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Operator Name
                    </th>
                    <th
                        class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Sent At
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sentLogs as $sentLog)
                    <tr>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $sentLog->clicked_id }}</p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $sentLog->service->name }}</p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $sentLog->operator->name }}</p>
                        </td>
                        <td class="text-center align-middle">
                            @php
                                $sentLog->sent_at = date('d-M-Y H:i:s a', strtotime($sentLog->sent_at));
                            @endphp
                            <p class="mb-0 text-xs font-weight-bold">{{ $sentLog->sent_at }}</p>
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
