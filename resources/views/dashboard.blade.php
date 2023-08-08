@extends('layouts.app')

@section('content')
<div class="row">
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="mb-0 font-weight-bolder">
                  $53,000
                  <span class="text-sm text-success font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg ni ni-money-coins opacity-10" aria-hidden="true"></i>
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
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Today's Users</p>
                <h5 class="mb-0 font-weight-bolder">
                  2,300
                  <span class="text-sm text-success font-weight-bolder">+3%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg ni ni-world opacity-10" aria-hidden="true"></i>
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
                <p class="mb-0 text-sm text-capitalize font-weight-bold">New Clients</p>
                <h5 class="mb-0 font-weight-bolder">
                  +3,462
                  <span class="text-sm text-danger font-weight-bolder">-2%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-primary border-radius-md">
                <i class="text-lg ni ni-paper-diploma opacity-10" aria-hidden="true"></i>
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
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Sales</p>
                <h5 class="mb-0 font-weight-bolder">
                  $103,430
                  <span class="text-sm text-success font-weight-bolder">+5%</span>
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
