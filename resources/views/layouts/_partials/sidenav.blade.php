@php
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="my-3 border-0 sidenav navbar navbar-vertical navbar-expand-xs border-radius-xl fixed-start ms-3"
    id="sidenav-main" style="background-color: #e0dddd;">
    <div class="flex sidenav-header border-r-[1px] border-gray-200">
        <i class="top-0 p-3 cursor-pointer fas fa-times text-secondary opacity-5 position-absolute end-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="m-0 navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img h-100 text-center mx-auto" alt="main_logo">
            <span class="ms-1 font-weight-bold">
                Promotion Panel
            </span>
        </a>
    </div>
    <hr class="mt-0 horizontal dark">
    <div class="w-auto navbar-collapse ps border-r-[1px] border-gray-200" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->can('dashboard'))
                <li class="nav-item">
                    <a class="nav-link @if ($currentRoute == 'dashboard') active @endif" href="{{ route('dashboard') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'dashboard') text-white @else  text-dark @endif fa-solid fa-shop fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('campaign-report'))
            <li class="mt-3 nav-item">
                <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Report sections</h6>
            </li>
            @endif
            @if (auth()->user()->can('campaign-report'))
            <li class="nav-item">
                <a class="nav-link  @if ($currentRoute == 'campaign.report') active @endif"
                    href="{{ route('campaign.report') }}">
                    <div
                        class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                        <i
                            class="@if ($currentRoute == 'campaign.report') text-white @else text-dark @endif fa-solid fa-bolt fa-xl"></i>
                    </div>
                    <span class="nav-link-text ms-1">Campaign Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  @if ($currentRoute == 'campaign.summary-report') active @endif"
                    href="{{ route('campaign.summary-report') }}">
                    <div
                        class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                        <i
                            class="@if ($currentRoute == 'campaign.summary-report') text-white @else text-dark @endif fa-solid fa-bolt fa-xl"></i>
                    </div>
                    <span class="nav-link-text ms-1">Summary Report</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('campaign') ||
                    auth()->user()->can('traffic'))
                <li class="mt-3 nav-item">
                    <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Campaign sections</h6>
                </li>
            @endif
            @if (auth()->user()->can('campaign'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'campaign.index' || $currentRoute == 'campaign.create' || $currentRoute == 'campaign.show') active @endif"
                        href="{{ route('campaign.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'campaign.index' || $currentRoute == 'campaign.create' || $currentRoute == 'campaign.show') text-white @else text-dark @endif fa-solid fa-paper-plane fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Campaign</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('traffic'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'traffic.index') active @endif"
                        href="{{ route('traffic.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'traffic.index') text-white @else text-dark @endif fa-solid fa-signal fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Traffic</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->can('operator') || auth()->user()->can('country') || auth()->user()->can('service') || auth()->user()->can('publisher'))
            <li class="mt-3 nav-item">
                <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Management sections</h6>
            </li>
            @endif
            @if (auth()->user()->can('user'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'user.index' || $currentRoute == 'user.view' || $currentRoute == 'user.create' || $currentRoute == 'user.edit') active @endif"
                        href="{{ route('user.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'user.index' || $currentRoute == 'user.view' || $currentRoute == 'user.create' || $currentRoute == 'user.edit') text-white @else text-dark @endif fa-solid fa-user fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('operator'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'operator.index') active @endif"
                        href="{{ route('operator.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'operator.index') text-white @else text-dark @endif fa-solid fa-handshake fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Operator</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('country'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'country.index') active @endif"
                        href="{{ route('country.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'country.index') text-white @else text-dark @endif fa-solid fa-earth-americas fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Country</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('service'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'service.index') active @endif"
                        href="{{ route('service.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'service.index') text-white @else text-dark @endif fa-solid fa-server fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Service</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('publisher'))
                <li class="nav-item">
                    <a class="nav-link  @if ($currentRoute == 'publisher.index') active @endif"
                        href="{{ route('publisher.index') }}">
                        <div
                            class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="@if ($currentRoute == 'publisher.index') text-white @else text-dark @endif fa-solid fa-user-check fa-xl"></i>
                        </div>
                        <span class="nav-link-text ms-1">Publisher</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->can('send-logs') || auth()->user()->can('receive-logs'))
            <li class="mt-3 nav-item">
                <h6 class="text-xs ps-4 ms-2 text-uppercase font-weight-bolder opacity-6">Postback sections</h6>
            </li>
            @endif
            @if (auth()->user()->can('send-logs'))
            <li class="nav-item">
                <a class="nav-link  @if ($currentRoute == 'post-back.send-logs') active @endif"
                    href="{{ route('post-back.send-logs') }}">
                    <div
                        class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                        <i
                            class="@if ($currentRoute == 'post-back.send-logs') text-white @else text-dark @endif fa-solid fa-arrow-up-right-dots fa-xl"></i>
                    </div>
                    <span class="nav-link-text ms-1">Send-logs</span>
                </a>
            </li>
            @endif
            @if (auth()->user()->can('receive-logs'))
            <li class="nav-item">
                <a class="nav-link  @if ($currentRoute == 'post-back.received-logs') active @endif"
                    href="{{ route('post-back.received-logs') }}">
                    <div
                        class="text-center bg-white shadow icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center">
                        <i
                            class="@if ($currentRoute == 'post-back.received-logs') text-white @else text-dark @endif fa-solid fa-arrow-up-right-dots fa-flip-vertical fa-xl"></i>
                    </div>
                    <span class="nav-link-text ms-1">received-logs</span>
                </a>
            </li>
            @endif

        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>

</aside>
