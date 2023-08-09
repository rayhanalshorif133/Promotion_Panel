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
            Publisher's List
        </li>
    </ol>
</nav>
@endsection


@section('content')
    <div class="w-full mx-auto">
        <h2 class="text-3xl font-bold text-gray-700">Publisher</h2>
    </div>

    <div class="w-10/12 mx-auto card">
        <div class="flex justify-between px-4 my-4">
            <h6>Publisher's List</h6>
            <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createPublisher">
                Add Publisher
            </button>
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
                            Name</th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Short Name</th>
                        <th
                            class="text-center align-middle text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Post Back URL</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $publisher)
                        <tr>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $loop->index + 1 }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $publisher->name }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">{{ $publisher->short_name }}</p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="mb-0 text-xs font-weight-bold">
                                    @if ($publisher->post_back_url)
                                        {{ $publisher->post_back_url }}
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">
                                            Not Set
                                        </span>
                                    @endif
                                </p>
                            </td>
                            <td class="text-sm text-center align-middle">
                                @if ($publisher->status == 'active')
                                    <span class="badge badge-sm bg-gradient-success">
                                        {{ $publisher->status }}
                                    </span>
                                @else
                                    <span class="badge badge-sm bg-gradient-danger">
                                        {{ $publisher->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @include('publisher.actionBtns', ['id' => $publisher->id])
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('publisher.createAndUpdate')
@endsection

@push('scripts')
@endpush
