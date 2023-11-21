<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::all();
        return view("index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => "required|string|max:255|min:3",
            'firstname' => "required|string|max:255|min:3",
            'email' => "required|email|unique:users,email",
            'password'=> "required|string|min:6|max:8",
            'address' => "required|string|max:255",
            'birthDate' => "required|date",
            'phone' => "nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
            'sexe' => "required|in:Male,Female,Other",
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            'typeCompte' => "required|in:Admin,User",
            'isBloqued' => "boolean"
        ], [
            'phone.regex' => 'Le format du numéro de téléphone n\'est pas valide.',
            'image.mimes' => 'Le format de l\'image doit être :jpeg, :png, :jpg ou :gif.'
        ]);

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('public/images');
        //     $validatedData['image'] = $imagePath;
        // }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $validatedData['image'] = "images/". $imageName;
        }

        user::create($validatedData);

        return redirect(route("users.index"))->with("success","Utilisateur crée avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return view("show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $validatedData = $request->validate([
            'name' => "required|string|max:255|min:3",
            'firstname' => "required|string|max:255|min:3",
            'email' => "required|email|unique:users,email," . $user->id,
            'address' => "required|string|max:255",
            'birthDate' => "required|date",
            'phone' => "nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
            'sexe' => "required|in:Male,Female,Other",
            'typeCompte' => "required|in:Admin,User"
        ], [
            'phone.regex' => 'Le format du numéro de téléphone n\'est pas valide.',
            'image.mimes' => 'Le format de l\'image doit être :jpeg, :png, :jpg ou :gif.'
        ]);

        $user->update($validatedData);

        return redirect(route('users.index'))->with('success','User mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
    
        if ($user) {
            $user->delete();
            return redirect(route('users.index'))->with('success', 'User supprimé avec succès');
        } else {
            return redirect(route('users.index'))->with('error', 'Utilisateur non trouvé');
        }
    }
       
}
