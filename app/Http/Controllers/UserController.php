<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::with(['clients', 'projects', 'tasks'])->select(['id', 'name', 'email', 'phone'])->orderBy('id', 'ASC')->paginate(10);
            return view('pages.users.index', ['users' => $users]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.users.form');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();

            User::create([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('users.index')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            return view('pages.users.form', ['user' => $user]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {        
            $validated = $request->validated();
            $user->update([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'users']);
        }
    }

}
