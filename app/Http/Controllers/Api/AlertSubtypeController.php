<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AlertSubtype;
use App\Http\Resources\AlertSubtypeResource;


class AlertSubtypeController extends BaseController
{
    public function index()
    {
        return AlertSubtypeResource::collection(AlertSubtype::all());
    }

    public function show($id)
    {
        return new AlertSubtypeResource(AlertSubtype::findOrFail($id));
    }

}
