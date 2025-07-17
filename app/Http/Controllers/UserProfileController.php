<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('userProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'service' => $request->service,
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $filename);
            $userData['image'] = 'images/profiles/' . $filename;
        }

        User::where('id', $user->id)->update($userData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}