<template>
  <div class="container-fluid d-flex justify-content-center align-items-start" style="background-color: #2C3E50; min-height: 100vh;">
    <div class="container mt-5">
      <h2 class="text-center text-white">Mes tâches</h2>
      <router-link to="/tasks/create" class="btn btn-primary mb-3">Ajouter une tâche</router-link>
      <!-- Message si aucune tâche n'est disponible -->
      <div v-if="tasks.length === 0" class="alert alert-info">
        No tasks available.
      </div>

      <!-- Liste des tâches -->
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="thead-dark" style="background-color: #2C3E50; color: white;">
            <tr>
              <th>#</th>
              <th>Titre</th>
              <th>Description</th>
              <th>Date de création</th>
              <th>Date d'échéance</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(task, index) in tasks" :key="task.id">
              <td>{{ index + 1 }}</td>
              <td>{{ task.title }}</td>
              <td>{{ task.description }}</td>
              <td>{{ task.created_at }}</td>
              <td>{{ task.due_date }}</td>
              <td>
                <span :class="{'badge badge-success': task.completed, 'badge badge-warning': !task.completed}">
                  {{ task.completed ? 'Completed' : 'Pending' }}
                </span>
              </td>
              <td>
                <router-link :to="{ name: 'editTask', params: { id: task.id } }" class="btn btn-sm btn-warning me-2">Modifier</router-link>
                <button @click="deleteTask(task.id)" class="btn btn-sm btn-danger">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  data() {
    return {
      tasks: [] as { id: number; title: string; description: string; due_date: string; completed: boolean }[]
    };
  },
  async created() {
    await this.fetchTasks();
  },
  methods: {
    async fetchTasks() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/tasks', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.tasks = response.data;
      } catch (error) {
        console.error('Failed to fetch tasks', error);
      }
    },
    async deleteTask(id: number) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.delete(`/tasks/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.tasks = this.tasks.filter(task => task.id !== id);
      } catch (error) {
        console.error('Failed to delete task', error);
      }
    }
  }
});
</script>

<style scoped>
/* Styles généraux */
body {
  background-color: #2C3E50;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.container {
  margin-top: 50px;
}

.table-hover tbody tr:hover {
  background-color: #E67E22;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(255, 255, 255, 0.05);
}

.thead-dark {
  background-color: #2C3E50;
}

.table {
  color: white;
}

.btn-primary {
  background-color: #E67E22;
  border-color: #E67E22;
}

.btn-primary:hover {
  background-color: #D35400;
}

.badge-warning {
  background-color: #f39c12;
}

.badge-success {
  background-color: #27ae60;
}

/* Media queries pour réactivité */
@media (max-width: 768px) {
  .container {
    margin-top: 20px;
    padding: 0 10px;
  }
  .table {
    font-size: 0.9em;
  }
  .btn-primary {
    width: 100%; /* Bouton pleine largeur sur mobile */
  }
  h2 {
    font-size: 1.5rem; /* Réduire la taille du titre */
  }
}

@media (max-width: 576px) {
  .table-responsive {
    overflow-x: auto;
  }
  td, th {
    white-space: nowrap; /* Prévenir le débordement */
  }
}
</style>
