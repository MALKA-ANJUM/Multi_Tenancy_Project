@extends('admin.layouts.layout')
@section('title', 'Tenants')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@lang('Tenants')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-ajax table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Domain')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tenants) > 0)
                                @foreach ($tenants as $index => $tenant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tenant->name }}</td>
                                    <td>{{ $tenant->domain }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="4">No data found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if (count($tenants) > 0)
                        {{ $tenants->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection