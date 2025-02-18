<?php
namespace App\Http\Controllers;

use App\Models\AlertType;

class AlertTypeController extends Controller
{
    public function index()
    {
        // Obtener todos los tipos de alerta con sus subtipos
        $alertTypes = AlertType::with('subtypes')->get();

        return response()->json($alertTypes);
    }
}
