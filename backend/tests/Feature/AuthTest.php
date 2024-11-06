<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Utilise cette fonctionnalité pour réinitialiser la base de données après chaque test

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
    }

   /* public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }*/
    public function test_user_can_login()
    {
        // Crée un utilisateur avec un mot de passe
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);
    
        // Effectue la requête de connexion
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
    
        // Vérifie que la réponse a un statut 200 OK
        $response->assertStatus(200);
    
        // Récupère le jeton d'authentification depuis la réponse
        $token = $response->json('token');
    
        // Vérifie que le token est bien généré
        $this->assertNotNull($token);
    
        // Effectue une requête authentifiée avec le jeton
        $authenticatedResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/tasks');  // Route protégée par authentification
    
        // Vérifie que l'accès aux tâches est autorisé (donc que l'utilisateur est authentifié)
        $authenticatedResponse->assertStatus(200);
    }
    

    /*public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum'); // Simule un utilisateur connecté

        $response = $this->postJson('/api/logout');

        $response->assertStatus(204);
        $this->assertGuest();
    }*/

  /*  public function test_user_can_logout()
{
    $user = User::factory()->create();

    // Simule un utilisateur connecté
    $this->actingAs($user, 'sanctum');

    // Récupère un token pour l'utilisateur
    $token = $user->createToken('auth-token')->plainTextToken;

    // Effectue la requête de déconnexion avec le token dans l'en-tête
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/logout');

    // Vérifie que la déconnexion renvoie un statut 204 (No Content)
    $response->assertStatus(204);
}*/

}
