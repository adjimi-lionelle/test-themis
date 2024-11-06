<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Déclare les champs qui peuvent être assignés en masse
    protected $fillable = [
        'title',         // Le titre de la tâche
        'description',   // La description de la tâche
        'due_date',      // La date d'échéance de la tâche
        'completed',     // Le statut de la tâche (complétée ou non)
        'user_id'        // L'ID de l'utilisateur associé à la tâche
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
