<?php

namespace App\Http\Controllers\Api;

use App\Models\Call;
use App\Http\Requests\Call\{CallStoreRequest, CallUpdateRequest};
use App\Http\Resources\CallResource;
use App\Http\Controllers\Api\BaseController;


class CallController extends BaseController
{
    public function getCallsByPatient($id)
    {
        // Buscar las llamadas asociadas al paciente
        $calls = Call::where('patientId', $id)->get();

        // Verificar si hay llamadas
        if ($calls->isEmpty()) {
            return $this->sendResponse([], 'No hay llamadas para este paciente', 200);
        }

        return $this->sendResponse(CallResource::collection($calls), 'Llamadas del paciente recuperadas con éxito', 200);
    }

    public function index()
    {
        return CallResource::collection(Call::all());
    }

    
    public function show(Call $call)
    {
        return $this->sendResponse(new CallResource($call), 'Paciente recuperado con éxito', 200);
    }

   
    public function store(CallStoreRequest $request)
    {
        $call = Call::create($request->validated());
        return $this->sendResponse($call, 'Paciente creado con éxito', 201);
    }

    
    public function update(Call $call, CallUpdateRequest $request)
    {
        $call->update($request->validated());
        return $this->sendResponse($call, 'Paciente actualizado con éxito', 200);
    }

    
    public function destroy(Call $call)
    {
        $call->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
