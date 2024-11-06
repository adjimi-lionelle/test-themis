<template>
  <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="background-color: #2C3E50; padding-top: 60px;">
    <div class="row shadow-lg" style="border-radius: 15px; overflow: hidden; height: 575px;">
      <!-- Section image -->
      <div class="col-md-6 p-0 d-lg-block">
        <img src="@/assets/login-image.png" alt="Login image" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;" />
      </div>
      
      <!-- Section formulaire -->
      <div class="col-md-6 bg-light p-5 d-flex align-items-center" style="height: 100%;">
        <div class="w-100">
          <form @submit.prevent="login">
            <div class="form-group mb-3">
              <input type="email" class="form-control" id="email" v-model="email" required placeholder="Entrez votre email" />
            </div>
            <div class="form-group mb-4">
              <input type="password" class="form-control" id="password" v-model="password" required placeholder="Entrez votre mot de passe" />
            </div>
            <button type="submit" class="btn btn-dark w-100 mb-4" style="background-color: #E67E22; border: none;">Se connecter</button>
            <div class="text-center">
              <span class="text-muted">Vous n'avez pas de compte ? </span><router-link to="/register" class="text-primary">Inscrivez-vous ici</router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import axios from 'axios';
import Vue from 'vue';

export default Vue.extend({
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        // Utiliser Axios directement
        const response = await axios.post('/login', {
          email: this.email,
          password: this.password
        });
        localStorage.setItem('userToken', response.data.token); // Stockez le jeton reçu du backend
        this.$router.push({ name: 'listTasks' });
      } catch (error) {
        console.error('Login failed', error);
      }
    }
  }
});
</script>

<style src="@/assets/auth.css"></style>
