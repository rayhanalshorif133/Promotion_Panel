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
<div class="row">
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">
                  Total Operators
                </p>
                <h5 class="mb-0 font-weight-bolder">
                  {{$operators}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg fa-solid fa-handshake opacity-10" aria-hidden="true"></i>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Total Services</p>
                <h5 class="mb-0 font-weight-bolder">
                  {{$services}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg fa-solid fa-server opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">
                  Total Publishers
                </p>
                <h5 class="mb-0 font-weight-bolder">
                  {{$publishers}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg fa-solid fa-user-check opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">
                  Total Campaigns
                </p>
                <h5 class="mb-0 font-weight-bolder">
                  {{$campaigns}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg ni ni-cart opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
