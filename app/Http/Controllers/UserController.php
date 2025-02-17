<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Zone::create($request->all());

        return redirect()->route('zones.index')
            ->with('success', 'Zone created successfully.');
    }

    public function show(Zone $zone)
    {
        return view('zones.show', compact('zone'));
    }

    public function edit(Zone $zone)
    {
        return view('zones.edit', compact('zone'));
    }

    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $zone->update($request->all());

        return redirect()->route('zones.index')
            ->with('success', 'Zone updated successfully');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $zone = Zone::findOrFail($id);
        
           
            $zone->delete();
            
            return redirect()->route('zones.index')->with('success', 'Zona eliminada correctament');
        }
    }