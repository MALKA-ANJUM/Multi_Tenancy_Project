@extends('tenant.layouts.layout')
@section('title', 'Projects')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Projects')</h2>
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
                        <a href="{{ route('tenant.projects.create') }}" class="btn btn-primary">
                            @lang('Add New Project')
                        </a>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-ajax table  table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Description')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($projects) > 0)
                            @foreach ($projects as $project)

                            <tr>
                                <td>{{ $project->name }}</td>

                                <td>{{ $project->description }}</td>

                                <td>
                                    <form action="{{ route('tenant.projects.status',$project->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="form-control">

                                            <option value="pending"
                                                {{ $project->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="in_progress"
                                                {{ $project->status == 'in_progress' ? 'selected' : '' }}>
                                                In Progress
                                            </option>

                                            <option value="completed"
                                                {{ $project->status == 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                        </select>
                                    </form>
                                </td>

                                <td>

                                    <a class="btn btn-outline-success"
                                        href="{{ route('tenant.projects.edit',$project->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{ route('tenant.projects.delete',$project->id) }}"
                                        class="btn btn-outline-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>

                            </tr>

                            @endforeach
                            @else

                            <tr>
                                <td colspan="4" class="text-center">No Data Found</td>
                            </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if (count($projects) > 0)
        {{ $projects->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
<!-- END: Content-->
@endsection