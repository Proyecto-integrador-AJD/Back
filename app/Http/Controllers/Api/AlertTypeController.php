<?php

namespace App\Http\Controllers\Api;

use App\Models\AlertType;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AlertTypeResource;

class AlertTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AlertTypeResource::collection(AlertType::all());
    }

    public function show($id)
    {
        return new AlertTypeResource(AlertType::findOrFail($id));
    }

}
