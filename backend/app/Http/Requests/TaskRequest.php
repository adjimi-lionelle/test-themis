<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string',      // Le titre doit être une chaîne de caractères s'il est présent
            'description' => 'sometimes|string', // La description doit être une chaîne de caractères s'il est présente
            'due_date' => 'sometimes|date',      // La date d'échéance doit être une date valide si elle est présente
            'completed' => 'sometimes|boolean',  // Le statut de complétion doit être un booléen s'il est présent
        ];
    }
}


