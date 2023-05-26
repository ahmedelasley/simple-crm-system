<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Http\Requests\TaskRequest;
use Exception;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::with(['user', 'project'])->select(['id', 'name', 'project_id', 'description', 'deadline', 'completed_at', 'user_id'])->orderBy('created_at', 'DESC')->paginate(10);
            return view('pages.tasks.index', ['tasks' => $tasks]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $projects = Project::select(['id', 'name'])->get();
            $users = User::select(['id', 'name'])->get();
            return view('pages.tasks.form', [
                'projects' => $projects,
                'users'   => $users,
            ]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            $validated = $request->validated();

            Task::create([
                'name'          => $validated['name'],
                'project_id'    => $validated['project_id'],
                'description'   => $validated['description'],
                'deadline'      => $validated['deadline'],
                'user_id'       => $validated['user_id'],
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            return view('pages.tasks.show', ['task' => $task]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' =>'There is no Task show' , 'url' => 'tasks']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
            $projects = Project::select(['id', 'name'])->get();
            $users = User::select(['id', 'name'])->get();
            return view('pages.tasks.form',[
                'task'    => $task,
                'projects' => $projects,
                'users'   => $users,
                
            ]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $validated = $request->validated();
            $task->update([
                'name'          => $validated['name'],
                'project_id'    => $validated['project_id'],
                'description'   => $validated['description'],
                'deadline'      => $validated['deadline'],
                'user_id'       => $validated['user_id'],
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => 'There is no Task updated' , 'url' => 'tasks']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->forceDelete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => 'There is no Task deleted' , 'url' => 'tasks']);
        }
    }
    
    /**
     * Completed the specified resource from storage.
     */
    public function completed(Task $task)
    {
        try {
            $task->update([
                'completed_at'  => now(),
            ]);
            return redirect()->route('tasks.index')->with('success', 'Task completed successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => 'There is no Task completed' , 'url' => 'tasks']);
        }
    }
    
    /**
     * Archive the specified resource from storage.
     */
    public function archive(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task archived successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => 'There is no Task archived' , 'url' => 'tasks']);
        }
    }

    public function archiveList()
    {
        try {
            $tasks = Task::with(['user', 'project'])->select(['id', 'name', 'project_id', 'description', 'deadline', 'completed_at', 'user_id'])->onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
            return view('pages.tasks.archive-list', ['tasks' => $tasks]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks.archiveList']);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        try {
            Task::withTrashed()->findOrFail($id)->restore();
            return redirect()->route('tasks.archiveList')->with('success', 'Task restore successfully.');
        } catch (\Exception $e) {                         
            return response()->view('errors.404', ['message' => 'There is no Task Restore' , 'url' => 'tasks.archiveList']);
        }

    }

    /**
     * RestoreAll the specified resource from storage.
     */
    public function restoreAll ()
    {
        try {
            Task::withTrashed()->restore();
            return redirect()->route('tasks.archiveList')->with('success', 'Task restore successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'tasks.archiveList']);
        }
    }

}
