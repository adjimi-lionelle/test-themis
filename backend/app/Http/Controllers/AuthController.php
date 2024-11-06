<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Enregistrer un nouvel utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    // Connexion de l'utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations de connexion sont incorrectes.'],
            ]);
        }

        // Créer un jeton d'accès personnel
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    // Déconnexion de l'utilisateur
   /* public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Déconnecté avec succès');
    }*/

   /* public function logout(Request $request)
    {
        // Vérifie que l'utilisateur est authentifié
        if ($user = $request->user()) {
            // Vérifie que l'utilisateur a un jeton actuel
            if ($user->currentAccessToken()) {
                // Supprime le jeton actuel
                $user->currentAccessToken()->delete();
                return response()->json(['message' => 'Logged out successfully'], 204);
            }

            // Si aucun jeton n'est trouvé
            return response()->json(['message' => 'No active token found'], 404);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }*/

    public function logout(Request $request)
    {
        // Vérifie si l'utilisateur est authentifié
        if ($request->user()) {
            // Supprime le token actuel de l'utilisateur
            $request->user()->currentAccessToken()->delete();

            // Retourne un statut 204 (No Content) pour indiquer que la déconnexion est réussie
            return response()->json(['message' => 'Logged out successfully'], 204);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }

}

