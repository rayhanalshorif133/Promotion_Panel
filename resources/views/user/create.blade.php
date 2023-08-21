@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item">
                <a class="opacity-3 text-dark" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li class="text-sm breadcrumb-item text-dark" aria-current="page">
                <a href="{{ route('dashboard') }}" class="text-blue-400">Dashboard</a>
            </li>
            <li class="text-sm breadcrumb-item text-dark" aria-current="page">
                <a href="{{ route('user.index') }}" class="text-blue-400">User List</a>
            </li>
            <li class="text-sm breadcrumb-item text-dark active" aria-current="page">
                New User
            </li>

        </ol>
    </nav>
@endsection

@section('content')
    <div class="w-full mx-auto mb-5">
        <h2 class="text-3xl font-bold text-gray-700">
            Create a new User
        </h2>
    </div>
    <div class="w-6/12 mx-auto card">
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="px-5 pt-5 pb-3 row">
                <div class="col-md-12">
                    <h5 class="text-lg">User Basic Info</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="required">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="User name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="required">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="User email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="optional">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="User password">
                        </div>
                        <div class="form-group">
                            <label for="password" class="optional">Confirmation Password</label>
                            <input type="password" class="form-control" id="password" name="password_confirmation"
                                placeholder="User password">
                        </div>
                        <div class="form-group">
                            <label for="role" class="required">Roles</label>
                            <select class="form-control" id="role" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userEditAccessPermissions" class="required">Permissions</label>
                            <select id="userEditAccessPermissions" name="permissions[]"
                                data-placeholder="Select permissions..." autocomplete="off" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="mt-2 btn bg-gradient-primary">Save</button>
                        @php
                            $previousUrl = url()->previous();
                        @endphp
                        <a href="{{ $previousUrl }}" class="mt-2 btn bg-gradient-secondary">Back</a>
                    </div>
                </div>
            </div>
        </form>
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
