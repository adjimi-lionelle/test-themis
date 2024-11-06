<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Afficher toutes les tâches de l'utilisateur connecté
    public function index(Request $request)
    {
        return $request->user()->tasks;
    }

    // Créer une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'completed' => 'boolean',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed' => false,
        ]);

        return response()->json($task, 201);
    }

    // Afficher une tâche spécifique
    public function show(Task $task)
    {
        return $task;
    }

    // Mettre à jour une tâche
    public function update(Request $request, Task $task)
    {
        // Autorisation : Vérifie si l'utilisateur peut mettre à jour cette tâche
        $this->authorize('update', $task);
    
        // Validation des données
        $validated = $request->validate([
            'title' => 'sometimes|string',      // Le titre doit être une chaîne de caractères s'il est présent
            'description' => 'sometimes|string', // La description doit être une chaîne de caractères s'il est présente
            'due_date' => 'sometimes|date',      // La date d'échéance doit être une date valide si elle est présente
            'completed' => 'sometimes|boolean',  // Le statut de complétion doit être un booléen s'il est présent
        ]);
    
        // Mise à jour de la tâche avec les données validées
        $task->update($validated);
    
        // Retourne la tâche mise à jour en réponse JSON
        return response()->json($task);
    }

    // Supprimer une tâche
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json("Task successfully deleted", 204);
    }
}

