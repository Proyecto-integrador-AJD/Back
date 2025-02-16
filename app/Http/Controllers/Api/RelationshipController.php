<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Relationship;
use App\Http\Resources\RelationshipResource;

class RelationshipController extends BaseController
{
    public function index()
    {
        return RelationshipResource::collection(Relationship::all());
    }

    public function show($id)
    {
        return new RelationshipResource(Relationship::findOrFail($id));
    }
}