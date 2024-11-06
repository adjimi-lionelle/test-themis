<template>
  <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="background-color: #2C3E50;">
    <div class="container mt-5">
      <h2 class="text-white text-center mb-4">Ajouter une Nouvelle tâche</h2>
      <!-- Bouton pour retourner à la liste des tâches -->
      <TaskForm :task="task" buttonText="Enregistrer" @submit="createTask" />
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import TaskForm from '@/components/TaskForm.vue';
import axios from 'axios';

@Component({
  components: {
    TaskForm
  }
})
export default class CreateTask extends Vue {
  // Déclaration des données
  task = {
    title: '',
    description: '',
    due_date: '',
    completed: false // Statut par défaut
  };

  // Méthode pour créer une tâche
  async createTask() {
    try {
      const token = localStorage.getItem('userToken'); // Récupérer le token d'authentification
      const response = await axios.post('/tasks', this.task, {
        headers: {
          Authorization: `Bearer ${token}` // Inclure le token dans l'en-tête
        }
      });
      this.$router.push({ name: 'listTasks' }); // Redirection
    } catch (error) {
      console.error('Failed to create task', error);
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
