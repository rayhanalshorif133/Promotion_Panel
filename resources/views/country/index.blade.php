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

    <div class="w-full px-[2rem] mx-auto lg:px-[4rem] lg:w-8/12 card">
        <div class="flex flex-col justify-between px-4 my-4 sm:flex-row">
            <h6 class="text-xl">Country's List</h6>
            <button class="mt-[5px] btn bg-gradient-primary btn-sm sm:mt-0" data-bs-toggle="modal" data-bs-target="#createCountry">
                Add Country
            </button>
        </div>
        <div class="pb-5 table-responsive">
            <table class="table table-bordered table-hover dt-responsive" id="countryTableId">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $country->name }}</td>
                        <td>
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
                        <td>
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
            $('#countryTableId').DataTable({
                responsive: true,
            });
        });
    </script>
@endpush
