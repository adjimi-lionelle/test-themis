<template>
  <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="background-color: #2C3E50;">
    <div class="container mt-5">
      <h2 class="text-white text-center mb-4">Modifier une tâche</h2>
      <TaskForm :task="task" buttonText="Modifier" :showStatusField="true" @submit="updateTask" />
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import TaskForm from '@/components/TaskForm.vue';
import axios from 'axios';
import { Component } from 'vue-property-decorator';

@Component({
  components: {
    TaskForm
  }
})

export default class EditTask extends Vue {
  // Déclaration des données
  task = {
    id: null as number | null,
    title: '',
    description: '',
    due_date: '',
    completed: false,
  };

  // Récupérer l'identifiant de la tâche et charger les données
  async created() {
    const taskId = this.$route.params.id;
    await this.fetchTask(Number(taskId)); // Cast `taskId` en nombre pour TypeScript
  }

  // Méthode pour récupérer les informations de la tâche
  async fetchTask(id: number): Promise<void> {
    try {
      const token = localStorage.getItem('userToken');
      const response = await axios.get(`/tasks/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      this.task = response.data;
    } catch (error) {
      console.error('Failed to fetch task', error);
    }
  }

  // Méthode pour mettre à jour la tâche
  async updateTask(): Promise<void> {
    try {
      const token = localStorage.getItem('userToken');
      await axios.put(`/tasks/${this.task.id}`, this.task, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      this.$router.push({ name: 'listTasks' });
    } catch (error) {
      console.error('Failed to update task', error);
    }
  }
}
</script>


<style scoped>
/* Fond bleu nuit pour toute la page */
.container-fluid {
  background-color: #2C3E50;
}

/* Styliser le texte en blanc */
.text-white {
  color: white;
}
</style>
