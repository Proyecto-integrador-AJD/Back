<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Http\Requests\Contact\{ContactStoreRequest, ContactUpdateRequest};
use App\Http\Resources\ContactResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Contacts API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class ContactController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Contacts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Contacts"))
     *     )
     * )
     */
    public function index()
    {
        return ContactResource::collection(Contact::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente recuperado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Contacts")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function show(Contact $contact)
    {
        return $this->sendResponse(new ContactResource($contact), 'Paciente recuperado con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     tags={"Contacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreContactRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Contacts")
     *     )
     * )
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->sendResponse($contact, 'Paciente creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/UpdateContactRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Contacts")
     *     )
     * )
     */
    public function update(Contact $contact, ContactUpdateRequest $request)
    {
        $contact->update($request->validated());
        return $this->sendResponse($contact, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente específico por su ID.",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente eliminado con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
