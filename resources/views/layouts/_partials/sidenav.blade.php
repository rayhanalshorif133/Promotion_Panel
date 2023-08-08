@php
   $currentRoute = Route::currentRouteName();
@endphp

<aside class="my-3 border-0 sidenav navbar navbar-vertical navbar-expand-xs border-radius-xl fixed-start ms-3 " id="sidenav-main">
    <div class="flex sidenav-header">
      <i class="top-0 p-3 cursor-pointer fas fa-times text-secondary opacity-5 position-absolute end-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="m-0 navbar-brand d-flex" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
        <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">
          Promotion Portal
        </span>
      </a>
    </div>
    <hr class="mt-0 horizontal dark">
    <div class="w-auto navbar-collapse ps" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link @if ($currentRoute == 'dashboard') active @endif" href="{{route('dashboard')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'dashboard') text-white @else  text-dark @endif fa-solid fa-shop fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="mt-3 nav-item">
          <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Management sections</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if ($currentRoute == 'operator.index') active @endif" href="{{route('operator.index')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'operator.index') text-white @else text-dark @endif fa-solid fa-handshake fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Operator</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if ($currentRoute == 'country.index') active @endif" href="{{route('country.index')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'country.index') text-white @else text-dark @endif fa-solid fa-earth-americas fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Country</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if ($currentRoute == 'service.index') active @endif" href="{{route('service.index')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'service.index') text-white @else text-dark @endif fa-solid fa-server fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Service</span>
          </a>
        </li>        
        <li class="nav-item">
          <a class="nav-link  @if ($currentRoute == 'publisher.index') active @endif" href="{{route('publisher.index')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'publisher.index') text-white @else text-dark @endif fa-solid fa-user-check fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Publisher</span>
          </a>
        </li>
        <li class="mt-3 nav-item">
          <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Management sections</h6>
        </li>
        <li class="mt-3 nav-item">
          <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Postback sections</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if ($currentRoute == 'service.index') active @endif" href="{{route('service.index')}}">
            <div class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
              <i class="@if ($currentRoute == 'service.index') text-white @else text-dark @endif fa-solid fa-server fa-xl"></i>
            </div>
            <span class="nav-link-text ms-1">Service</span>
          </a>
        </li>
      </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>  
    <div class="mx-3 sidenav-footer ">
      <a class="mt-3 btn bg-gradient-primary w-100" href="{{route('dashboard')}}">Home</a>
    </div>
  </aside>