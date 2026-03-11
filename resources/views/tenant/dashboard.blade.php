@extends('tenant.layouts.layout')
@section('title', 'Dashboard')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        @if (Session::has('success'))
            <p class="alert alert-success text-center fs-3 py-1">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-danger text-center fs-3 py-1"> {{ Session::get('error') }}</p>
        @endif
        <div class="content-body">
            <div class="row">
              
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
