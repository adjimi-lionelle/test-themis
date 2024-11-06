<template>
  <div class="container-fluid vh-100 d-flex justify-content-center align-items-center auth-container" style="background-color: #2C3E50;">
    <div class="row shadow-lg" style="border-radius: 15px; overflow: hidden; height: 575px;">
      <!-- Section image -->
      <div class="col-md-6 p-0 d-lg-block ">
        <img src="@/assets/login-image.png" alt="Image d'inscription" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;" />
      </div>

      <!-- Section formulaire -->
      <div class="col-md-6 bg-light p-5 d-flex align-items-center" style="height: 100%;">
        <div class="w-100">
          <form @submit.prevent="register">
            <div class="form-group mb-3">
              <input type="text" class="form-control" id="name" v-model="name" required placeholder="Entrez votre nom" />
            </div>
            <div class="form-group mb-3">
              <input type="email" class="form-control" id="email" v-model="email" required placeholder="Entrez votre adresse email" />
            </div>
            <div class="form-group mb-3">
              <input type="password" class="form-control" id="password" v-model="password" required placeholder="Entrez votre mot de passe" />
            </div>
            <div class="form-group mb-4">
              <input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation" required placeholder="Confirmez votre mot de passe" />
            </div>
            <button type="submit" class="btn btn-dark w-100 mb-4" style="background-color: #E67E22; border: none;">S'INSCRIRE</button>
            <div class="text-center">
              <span class="text-muted">Vous avez déjà un compte ? </span><router-link to="/login" class="text-primary">Connectez-vous ici</router-link>
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
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        });
        localStorage.setItem('userToken', response.data.token); // Stocker le jeton reçu du backend
        this.$router.push({ name: 'tasks' });
      } catch (error) {
        console.error("Échec de l'inscription", error);
      }
    }
  }
});
</script>

<style src="@/assets/auth.css"></style>
