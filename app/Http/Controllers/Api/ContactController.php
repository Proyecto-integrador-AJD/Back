<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Requests\Contact\{ContactStoreRequest, ContactUpdateRequest};
use App\Http\Resources\{ContactResource};
use App\Http\Controllers\Api\BaseController;


class ContactController extends BaseController
{
    public function index()
    {
        return ContactResource::collection(Contact::all());
    }

    
    public function show(Contact $contact)
    {
        return $this->sendResponse(new ContactResource($contact), 'Contacto recuperado con éxito', 200);
    }

    
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->sendResponse($contact, 'Contacto creado con éxito', 201);
    }

    
    public function update(Contact $contact, ContactUpdateRequest $request)
    {
        $contact->update($request->validated());
        return $this->sendResponse($contact, 'Contacto actualizado con éxito', 200);
    }

   
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse(null, 'Contacto eliminado con éxito', 200);
    }
}
