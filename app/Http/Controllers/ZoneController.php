<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        $zones = Zone::all();
        return view('zones.index', compact('zones'));
    }
    
    public function create()
    {
        return view('zones.create');
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

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()->route('zones.index')
            ->with('success', 'Zone deleted successfully');
    }




}
