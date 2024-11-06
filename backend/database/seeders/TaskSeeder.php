<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère l'utilisateur que nous avons créé dans le UserSeeder
        $user = User::first();

        // Crée plusieurs tâches pour cet utilisateur
        Task::create([
            'title' => 'Complete Laravel Project',
            'description' => 'Finish the development and deploy the Laravel project.',
            'due_date' => Carbon::now()->addDays(7),
            'completed' => false,
            'user_id' => $user->id, // Associe la tâche à l'utilisateur
        ]);

        Task::create([
            'title' => 'Write Documentation',
            'description' => 'Write the documentation for the Laravel project.',
            'due_date' => Carbon::now()->addDays(10),
            'completed' => false,
            'user_id' => $user->id,
        ]);

        Task::create([
            'title' => 'Fix Bugs',
            'description' => 'Fix the reported bugs in the Laravel project.',
            'due_date' => Carbon::now()->addDays(5),
            'completed' => true,
            'user_id' => $user->id,
        ]);
    }
}
