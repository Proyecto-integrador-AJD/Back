<?php

namespace App\Http\Controllers\Api;

use App\Models\SubTypeCall;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SubTypeCallResource;

class SubTypeCallController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubTypeCallResource::collection(SubTypeCall::all());
    }

    public function show($id)
    {
        return new SubTypeCallResource(SubTypeCall::findOrFail($id));
    }

}
