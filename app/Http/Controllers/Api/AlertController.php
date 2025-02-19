<?php

namespace App\Http\Controllers\Api;

use App\Models\Alert;
use App\Models\Patient;
use App\Http\Requests\Alert\{AlertStoreRequest, AlertUpdateRequest};
use App\Http\Resources\AlertResource;
use App\Http\Controllers\Api\BaseController;


class AlertController extends BaseController
{
    public function user()
    {
        $userId = auth()->id(); // Obtener ID del usuario autenticado
        $result = Patient::where('userId', $userId)->pluck('id')->toArray();
        $alerts = Alert::whereIn('patientId', $result)->get();
    
        return $this->sendResponse(AlertResource::collection($alerts), 'Alertas asignadas al usuario recuperadas con éxito', 200);
    }

    public function unassigned()
    {
        // Obtener todas las alertas cuyo ID no está en ninguna llamada
        $alerts = Alert::whereNotIn('id', function ($query) {
            $query->select('alertId')->from('calls');
        })->get();

        return $this->sendResponse(AlertResource::collection($alerts), 'Alertas sin llamas asignadas recuperadas con éxito', 200);
    }

 
    public function index()
    {
        return AlertResource::collection(Alert::all());
    }

   
    public function show(Alert $alert)
    {
        return $this->sendResponse(new AlertResource($alert), 'Paciente recuperado con éxito', 200);
    }

   
    public function store(AlertStoreRequest $request)
    {
        $alert = Alert::create($request->validated());
        return $this->sendResponse($alert, 'Paciente creado con éxito', 201);
    }

    
    public function update(Alert $alert, AlertUpdateRequest $request)
    {
        $alert->update($request->validated());
        return $this->sendResponse($alert, 'Paciente actualizado con éxito', 200);
    }

   
    public function destroy(Alert $alert)
    {
        $alert->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
