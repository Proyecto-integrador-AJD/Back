<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Models\Contact;
use App\Models\Language;
use App\Models\Prefix;
use App\Models\Zone;
use App\Models\Patient;
use App\Models\Relationship;


class ContactController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $contacts = Contact::all();
        

        return view('contacts.index', compact('contacts'));
    }
    
    public function create()
    {
        $prefixes = Prefix::all();
        return view('contacts.create', compact( 'prefixes'));
    }
    

    public function store(ContactStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');


            $validated = $request->validated(); 
        
            Contact::create($validated);
        
            return redirect()->route('contact.index')->with('success', 'Contacto creado correctamente!');
    }

    public function show(Contact $contact)
    {
        
        
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        // return view('users.edit', compact('user'));
        $contact = Contact::findOrFail($id);
        $prefixes = Prefix::all();
        $patients = Patient::all();
        $relationships=Relationship::all();
        return view('contacts.edit', compact('contact', 'prefixes', 'patients', 'relationships'));

    }

    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // $zone->update($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone updated successfully');

        $validated = $request->validated();

        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contacto actualizado correctamente!');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $contact = Contact::findOrFail($id);
        
           
            $contact->delete();
            
            return redirect()->route('contacts.index')->with('success', 'Contacto eliminado correctamente');
        }
    }



