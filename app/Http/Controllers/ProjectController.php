<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('users')->paginate(10);
        return view('tenant.projects.list', compact('projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('tenant.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $project->users()->sync($request->users);

        return redirect()->route('tenant.projects')->with('success', 'Project Added Successfully');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();

        return view('tenant.projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $project->users()->sync($request->users);
        return redirect()->route('tenant.projects')->with('success', 'Project Updated Successfully');
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('tenant.projects')->with('success', 'Project Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $project = Project::where('id', $id)->first();

        $project->status = $request->status;
        $project->save();

        return back()->with('success', 'Status Updated Successfully');
    }
}
