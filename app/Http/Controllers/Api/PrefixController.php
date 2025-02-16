<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Prefix;
use App\Http\Resources\PrefixResource;

class PrefixController extends BaseController
{
    public function index()
    {
        return PrefixResource::collection(Prefix::all());
    }

    public function show($id)
    {
        return new PrefixResource(Prefix::findOrFail($id));
    }
}
