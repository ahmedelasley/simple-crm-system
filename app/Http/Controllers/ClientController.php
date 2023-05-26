<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clients = Client::with(['user', 'projects'])->select(['id', 'name', 'email', 'phone', 'address', 'image', 'user_id'])->orderBy('created_at', 'DESC')->paginate(10);
            return view('pages.clients.index', ['clients' => $clients]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.clients.form');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try {
            $validated = $request->validated();
            Client::create([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'address'   => $validated['address'],
                'image'     => $validated['image']->store('assets/images/clients', 'picture'),
                'user_id'   => Auth::user()->id,
            ]);

            return redirect()->route('clients.index')->with('success', 'Client added successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        try {
            return view('pages.clients.show', ['client' => $client]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        try {
            return view('pages.clients.form', ['client' => $client]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $validated = $request->validated();
            if ($client) {
                File::delete($client->image);
            }
            $client->update([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'phone'     => $validated['phone'],
                'address'   => $validated['address'],
                'image'     => $validated['image']->store('assets/images/clients', 'picture'),
                'user_id'   => Auth::user()->id,
            ]);

            return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            $client->forceDelete();
            return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Archive the specified resource from storage.
     */
    public function archive(Client $client)
    {
        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Client archived successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }
    
    public function archiveList()
    {
        try {
            $clients = Client::with(['user', 'projects'])->select(['id', 'name', 'email', 'phone', 'address', 'image', 'user_id'])->onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
            return view('pages.clients.archive-list', ['clients' => $clients]);
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        try {
            Client::withTrashed()->find($id)->restore();
            return redirect()->route('clients.archiveList')->with('success', 'Client restore successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }

    /**
     * RestoreAll the specified resource from storage.
     */
    public function restoreAll ()
    {
        try {
            Client::withTrashed()->restore();
            return redirect()->route('clients.archiveList')->with('success', 'Client restore successfully.');
        } catch (\Exception $e) {
            return response()->view('errors.404', ['message' => $e->getMessage() , 'url' => 'clients']);
        }
    }
}
