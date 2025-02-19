<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Patient\PatientStoreRequest;
use App\Http\Requests\Patient\PatientUpdateRequest;
use App\Models\Patient;
use App\Models\Language;
use App\Models\Prefix;
use App\Models\Zone;


class PatientController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $patients = Patient::all();
        
        $languages = Language::all();
        $lenguajes=[];


        return view('patients.index', compact('patients'));
    }
    
    public function create()
    {
        $prefixes = Prefix::all();
        $zones = Zone::all();  
        $languages = Language::all()->pluck('spanishName', 'name');  // Obtiene todos los idiomas (nombre en español)
        return view('patients.create', compact('languages', 'prefixes', 'zones'));
    }
    

    public function store(PatientStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');


            $validated = $request->validated(); 
        
            Patient::create($validated);
        
            return redirect()->route('patients.index')->with('success', 'Paciente creado correctamente!');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        // return view('users.edit', compact('user'));
        $patient = Patient::findOrFail($id);
        $prefixes = Prefix::all();
        $zones = Zone::all();
        $languages = Language::all()->pluck('spanishName', 'name');  // Obtiene todos los idiomas en su nombre español
        return view('patients.edit', compact('patient', 'languages', 'prefixes', 'zones'));

    }

    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // $zone->update($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone updated successfully');

        $validated = $request->validated();

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Paciente actualizado correctamente!');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $patient = Patient::findOrFail($id);
        
           
            $patient->delete();
            
            return redirect()->route('patients.index')->with('success', 'Paciente eliminado correctamente');
        }
    }



