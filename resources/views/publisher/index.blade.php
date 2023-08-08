@extends('layouts.app')

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
