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
            Country's List
        </li>
    </ol>
</nav>

@endsection


@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">country</h2>
    </div>

    <div class="w-8/12 px-5 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6 class="text-xl">Country's List</h6>
            <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createCountry">
                Add Country
            </button>
        </div>
        <div class="pb-5 table-responsive">
            <table class="table px-2 pb-3 mb-0 align-items-center" id="countryTableId">
                <thead>
                    <tr>
                        <th class="text-xs text-center align-middle text-uppercase text-secondary font-weight-bolder opacity-7">#</th>
                        <th class="text-xs text-center align-middle text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Name</th>
                        <th class="text-xs text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                            Status</th>
                        <th class="text-xs text-center text-uppercase text-secondary font-weight-bolder opacity-7">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $loop->index + 1  }}</p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="mb-0 text-xs font-weight-bold">{{ $country->name }}</p>
                        </td>
                        <td class="text-sm text-center align-middle">
                            @if($country->status == 'active')
                            <span class="badge badge-sm bg-gradient-success">
                                {{ $country->status }}
                            </span>
                            @else
                            <span class="badge badge-sm bg-gradient-danger">
                                {{ $country->status }}
                            </span>
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @include('country.actionBtns',['id' => $country->id])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('country.createAndUpdate')
@endsection

@push('scripts')
    <script>
        $(function(){
            $('#countryTableId').DataTable();
        });
    </script>
@endpush
