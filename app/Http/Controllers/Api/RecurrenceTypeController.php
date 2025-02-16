<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RecurrenceType;
use App\Http\Resources\RecurrenceTypeResource;

class RecurrenceTypeController extends BaseController
{
    public function index()
    {
        return RecurrenceTypeResource::collection(RecurrenceType::all());
    }

    public function show($id)
    {
        return new RecurrenceTypeResource(RecurrenceType::findOrFail($id));
    }
}
