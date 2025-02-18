<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Alert;
use App\Models\Patient;
use App\Models\User;
use App\Models\RecurrenceType;
use App\Http\Requests\Alert\AlertStoreRequest;
use App\Http\Requests\Alert\AlertUpdateRequest;

class AlertController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $alerts = Alert::with('patient')->get();
        // $alerts = Alert::all();
        return view('alerts.index', compact('alerts'));
    }
    
    public function create()
    {
        $patients = Patient::all();
        $users = User::all();   
        $recurrenceTypes = RecurrenceType::all();    
        return view('alerts.create', compact('patients', 'users', 'recurrenceTypes'));
    }

    public function store(AlertStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');

        // $currentEmail = $this->route('alert');

            $validated = $request->validated(); 
        
            Alert::create($validated);
        
            return redirect()->route('alerts.index')->with('success', 'Laerta creada correctamente!');
    }

    public function show(Alert $alert)
    {
        return view('alerts.show', compact('alert'));
    }

    public function edit(Alert $alert)
    {
        $patients = Patient::all();
        $recurrenceTypes = RecurrenceType::all();
        return view('alerts.edit', compact('alert', 'patients', 'recurrenceTypes'));
    }

    public function update(AlertUpdateRequest $request, Alert $alert)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // $zone->update($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone updated successfully');

        $validated = $request->validated();

        $alert->update($validated);

        return redirect()->route('alerts.index')->with('success', 'Alerta actualizada correctamente!');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $alert = Alert::findOrFail($id);
        
           
            $alert->delete();
            
            return redirect()->route('alerts.index')->with('success', 'Alerta eliminada correctamente');
        }
    }
