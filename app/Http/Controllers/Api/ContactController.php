<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Requests\Contact\{ContactStoreRequest, ContactUpdateRequest};
use App\Http\Resources\{ContactResource};
use App\Http\Controllers\Api\BaseController;


class ContactController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     summary="Obtener todos los contactos",
     *     description="Devuelve una lista de todos los contactos.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Contacts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de contactos devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ContactResource"))
     *     )
     * )
     */
    public function index()
    {
        return ContactResource::collection(Contact::all());
    }

     /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     summary="Obtener un contacto",
     *     description="Devuelve los detalles de un contacto específico por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contacto recuperado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contacto no encontrado."
     *     )
     * )
     */
    public function show(Contact $contact)
    {
        return $this->sendResponse(new ContactResource($contact), 'Contacto recuperado con éxito', 200);
    }

     /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Crear un nuevo contacto",
     *     description="Crea un nuevo contacto con los datos proporcionados.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Contacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ContactStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contacto creado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     )
     * )
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->sendResponse($contact, 'Contacto creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Actualizar un contacto",
     *     description="Actualiza los datos de un contacto existente.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ContactUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contacto actualizado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     )
     * )
     */
    public function update(Contact $contact, ContactUpdateRequest $request)
    {
        $contact->update($request->validated());
        return $this->sendResponse($contact, 'Contacto actualizado con éxito', 200);
    }

   /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     summary="Eliminar un contacto",
     *     description="Elimina un contacto específico por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contacto eliminado con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contacto no encontrado."
     *     )
     * )
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse(null, 'Contacto eliminado con éxito', 200);
    }
}
