<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Call\CallStoreRequest;
use App\Http\Requests\Call\CallUpdateRequest;
use App\Models\Patient;
use App\Models\User;
use App\Models\Alert;
use App\Models\Call;



class CallController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $calls = Call::all();


        return view('calls.index', compact('calls'));
    }
    
    public function create()
    {
        $patients = Patient::all();  
        $users = User::all();  
        $alerts = Alert::all();  
        return view('calls.create', compact('patients', 'users', 'alerts'));
    }
    

    public function store(CallStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');


            $validated = $request->validated(); 
        
            Call::create($validated);
        
            return redirect()->route('calls.index')->with('success', 'Llamada creada correctamente!');
    }

    public function show(Call $call)
    {
        return view('calls.show', compact('call'));
    }

    public function edit($id)
    {
        // return view('users.edit', compact('user'));
        $call = Call::findOrFail($id);
        $patients = Patient::all(); 
        $users = User::all();  
        return view('calls.edit', compact('call', 'patients', 'users'));

    }

    public function update(CallUpdateRequest $request, Call $call)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // $zone->update($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone updated successfully');

        $validated = $request->validated();

        $call->update($validated);

        return redirect()->route('calls.index')->with('success', 'Llamada actualizada correctamente!');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $call = Call::findOrFail($id);
        
           
            $call->delete();
            
            return redirect()->route('calls.index')->with('success', 'Llamada eliminada correctamente');
        }
    }