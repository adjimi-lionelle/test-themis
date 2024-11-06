<template>

  <div class="d-flex justify-content-center align-items-center vh-70" style="background-color: #2C3E50;">
    <div class="card p-5 shadow-lg" style="border-radius: 15px; max-width: 500px; width: 100%;">

      <div class="text-center mb-5">
        <router-link to="/tasks" class="btn btn-secondary">Retour à la liste</router-link>
      </div>
      <form @submit.prevent="submitForm">
        <div class="form-group mb-3">
          <label for="title">Titre</label>
          <input type="text" class="form-control" id="title" v-model="task.title" required />
        </div>
        <div class="form-group mb-3">
          <label for="description"> Description</label>
          <textarea class="form-control" id="description" v-model="task.description" rows="3" required></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="due_date">Date d'échéance</label>
          <input type="date" class="form-control" id="due_date" v-model="task.due_date" required />
        </div>
        
        <!-- Affichage du champ Statut uniquement si `showStatusField` est vrai -->
        <div v-if="showStatusField" class="form-group mb-3">
          <label for="status">Statut</label>
          <select class="form-control" id="status" v-model="task.completed">
            <option :value="false">Pending / In Progress</option> <!-- Correspond à `false` dans la base de données -->
            <option :value="true">Completed</option> <!-- Correspond à `true` dans la base de données -->
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3" style="background-color: #E67E22; border: none;">
          {{ buttonText }}
        </button>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';

export default Vue.extend({
  props: {
    task: {
      type: Object,
      required: true
    },
    buttonText: {
      type: String,
      default: 'Submit'
    },
    showStatusField: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    submitForm() {
      this.$emit('submit'); // Émettre un événement de soumission
    }
  }
});
</script>


<style scoped>
/* Style pour centrer le contenu et donner un fond de page */
body {
  background-color: #2C3E50;
}

.btn-secondary {
  background-color: #E67E22;
  border-color: #E67E22;
}
.btn-secondary:hover {
   background-color: #D35400;
}

.btn-secondary + form {
  margin-top: 0;
}
</style>
