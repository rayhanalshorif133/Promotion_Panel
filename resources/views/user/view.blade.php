@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
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
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">
            User Details
        </h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="px-5 py-4 card">
                <h5 class="text-xl">User Basic Info</h5>
                <div class="h-[1px] w-[90%] bg-gray-200 my-2"></div>
                <div class="flex justify-start space-x-2">
                    <div>
                        <p class="mr-2 font-semibold text-gray-700">Name:</p>
                    </div>
                    <div>
                        <p class="text-gray-500">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="flex justify-start space-x-2">
                    <div>
                        <p class="mr-2 font-semibold text-gray-700">Email:</p>
                    </div>
                    <div>
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex justify-start space-x-2">
                    <div>
                        <p class="mr-2 font-semibold text-gray-700">Role:</p>
                    </div>
                    <div>
                        @if ($user->roles[0]->name == 'admin') 
                            <span class='badge bg-gradient-primary'>{{ $user->roles[0]->name}}</span>
                        @else
                            <span class='badge bg-gradient-secondary'>{{ $user->roles[0]->name}}</span>
                        @endif
                    </div>
                </div>
                <div class="flex justify-start space-x-2">
                    <div>
                        <p class="mr-2 font-semibold text-gray-700">Status:</p>
                    </div>
                    <div>
                        @if ($user->status == 'active') 
                            <span class='badge bg-gradient-info'>{{ $user->status}}</span>
                        @else
                            <span class='badge bg-gradient-warning'>{{ $user->status}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="px-5 py-4 card">
                <h5 class="text-xl">User's Permissions</h5>
                <div class="h-[1px] w-[90%] bg-gray-200 my-2"></div>
                <div class="flex justify-start space-x-2">
                    <div>
                        @if ($user->status == 'active') 
                            <span class='badge bg-gradient-info'>{{ $user->status}}</span>
                        @else
                            <span class='badge bg-gradient-warning'>{{ $user->status}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            new TomSelect('#userEditAccessPermissions', {
                plugins: ['remove_button'],
            });
        });
    </script>
@endpush
