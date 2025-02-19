<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeCall;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TypeCallResource;

class TypeCallController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeCallResource::collection(TypeCall::all());
    }

    public function show($id)
    {
        return new TypeCallResource(TypeCall::findOrFail($id));
    }

}
