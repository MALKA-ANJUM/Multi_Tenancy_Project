@extends('tenant.layouts.layout')
@section('title', 'Update Project')

@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper container-xxl p-0">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Update Project</h2>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="content-body">
            <div class="card w-100">
                <div class="card-body">

                    <form action="{{ route('tenant.projects.update',$project->id) }}" method="POST">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label class="form-label">Project Name</label>
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    value="{{ old('name',$project->name) }}"
                                    placeholder="Enter Project Name">

                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    placeholder="Enter Description">{{ old('description',$project->description) }}</textarea>

                            </div>


                            <div class="col-md-6 mt-1">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
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

                            </div>


                            <div class="col-md-6 mt-1">
                                <label class="form-label">Assign Users</label>
                                <select name="users[]" class="form-control select2" multiple>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id,$project->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Project
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection