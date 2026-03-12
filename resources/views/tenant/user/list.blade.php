@extends('tenant.layouts.layout')
@section('title', 'Users')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Users')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-header border-bottom">
                    <div id="tableHeaderDiv">
                        @can('tenant.add-user-form')
                        <a href="{{ route('tenant.add-user-form') }}" class="btn btn-primary">
                            @lang('Add New User')
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-ajax table  table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Created Date')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Role')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ date('d/m/Y h : i A', strtotime($user->created_at)) }}
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getRoleNames()->first()}}</td>
                                <td>
                                    @can('tenant.edit-user')
                                    <a class="btn btn-outline-success" href="{{route('tenant.edit-user',['id' => $user->id])}}" id="editschool"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('tenant.delete-user')
                                    <a href="{{route('tenant.delete-user',['id' => $user->id])}}" class="btn btn-outline-danger text-danger"><i
                                            class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">@lang('No Data Found')</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if (count($users) > 0)
        {{ $users->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
<!-- END: Content-->
@endsection