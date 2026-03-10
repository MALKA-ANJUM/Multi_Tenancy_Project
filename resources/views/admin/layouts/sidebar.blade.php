<!-- BEGIN: sidebar Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header height-side-bar navbar-header-height">
        <ul class="nav navbar-nav flex-row h-100">
            <li class="nav-item me-auto h-100" style="margin: auto;">

            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if ( request()->is('admin/dashboard') ) active  @endif  nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Dashboard')</span>
                </a>
            </li>

            <li class="@if ( request()->is('admin/tenant-list') ) active  @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.tenant.list') }}">
                    <i data-feather="message-circle"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Tenants')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- End: sidebar Menu-->