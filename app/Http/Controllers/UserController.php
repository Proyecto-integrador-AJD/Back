<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Language;
use App\Models\Prefix;

class UserController extends Controller
{

    use AuthorizesRequests;
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    
    public function create()
    {
        $prefixes = Prefix::all();
        $languages = Language::all()->pluck('spanishName', 'name');  // Obtiene todos los idiomas (nombre en español)
        return view('users.create', compact('languages', 'prefixes'));
    }
    

    public function store(UserStoreRequest $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // Zone::create($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone created successfully.');


            $validated = $request->validated(); 
        
            User::create($validated);
        
            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        // return view('users.edit', compact('user'));
        $user = User::findOrFail($id);
        $prefixes = Prefix::all();
        
        $languages = Language::all()->pluck('spanishName', 'name');  // Obtiene todos los idiomas en su nombre español
        return view('users.edit', compact('user', 'languages', 'prefixes'));

    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        // $zone->update($request->all());

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone updated successfully');

        $validated = $request->validated();

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente!');
    }

    public function destroy($id)
    {
        // $zone->delete();

        // return redirect()->route('zones.index')
        //     ->with('success', 'Zone deleted successfully');

            $user = User::findOrFail($id);
        
           
            $user->delete();
            
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
        }
    }



