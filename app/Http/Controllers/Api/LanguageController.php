<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Resources\LanguageResource;

class LanguageController extends BaseController
{
    public function index()
    {
        return LanguageResource::collection(Language::all());
    }

    public function show($id)
    {
        return new LanguageResource(Language::findOrFail($id));
    }
}
