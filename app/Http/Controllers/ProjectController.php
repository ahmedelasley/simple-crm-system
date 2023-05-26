<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $projects = Project::with(['user', 'client', 'tasks'])->select(['id', 'name', 'description', 'deadline', 'client_id', 'user_id', 'status'])->orderBy('created_at', 'DESC')->paginate(10);
            return view('pages.projects.index', ['projects' => $projects]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        try {
            $clients = Client::select(['id', 'name'])->get();
            $users = User::select(['id', 'name'])->get();
            return view('pages.projects.form', [
                'clients' => $clients,
                'users'   => $users,
            ]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            $validated = $request->validated();
            Project::create([
                'name'          => $validated['name'],
                'description'   => $validated['description'],
                'deadline'      => $validated['deadline'],
                'client_id'     => $validated['client_id'],
                'user_id'       => $validated['user_id'],
                'status'        => $validated['status'],
            ]);

            return redirect()->route('projects.index')->with('success', 'Project added successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            return view('pages.projects.show', ['project' => $project]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            $clients = Client::select(['id', 'name'])->get();
            $users = User::select(['id', 'name'])->get();
            return view('pages.projects.form',[
                'project' => $project,
                'clients' => $clients,
                'users'   => $users,
                
            ]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try {
            $validated = $request->validated();
            $project->update([
                'name'          => $validated['name'],
                'description'   => $validated['description'],
                'deadline'      => $validated['deadline'],
                'client_id'     => $validated['client_id'],
                'user_id'       => $validated['user_id'],
                'status'        => $validated['status'],
            ]);

            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->forceDelete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Archive the specified resource from storage.
     */
    public function archive(Project $project)
    {
        try {
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Project archived successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }
    
    public function archiveList()
    {
        try {
            $projects = Project::with(['user', 'client', 'tasks'])->select(['id', 'name', 'description', 'deadline', 'client_id', 'user_id', 'status'])->onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
            return view('pages.projects.archive-list', ['projects' => $projects]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        try {
            Project::withTrashed()->find($id)->restore();
            return redirect()->route('projects.archiveList')->with('success', 'Project restore successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

    /**
     * RestoreAll the specified resource from storage.
     */
    public function restoreAll ()
    {
        try {
            Project::withTrashed()->restore();
            return redirect()->route('projects.archiveList')->with('success', 'Project restore successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'projects']);
        }
    }

}
