<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Http\Requests\ZoneStoreRequest;
use App\Http\Requests\ZoneUpdateRequest;

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

    public function store(ZoneStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');


            $validated = $request->validated(); 
        
            Zone::create($validated);
        
            return redirect()->route('zones.index')->with('success', 'Zona creada correctament!');
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



