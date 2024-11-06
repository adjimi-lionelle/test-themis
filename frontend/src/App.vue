<template>
  <div id="app">
    <!-- Afficher la nav seulement si on n'est pas sur les pages login ou register -->
    <div v-if="showNav" id="nav">
      <button @click="logout" class="btn btn-link">Se déconnecter</button>
    </div>
    <router-view />
  </div>
</template>

<script>
export default {
  computed: {
    showNav() {
      // Afficher la nav seulement si la route actuelle n'est pas "login" ou "register"
      return this.$route.name !== 'login' && this.$route.name !== 'register';
    }
  },
  methods: {
    logout() {
      // Effacer le jeton de l'utilisateur du stockage local
      localStorage.removeItem('userToken');
      // Rediriger vers la page de login
      this.$router.push({ name: 'login' });
    }
  }
};
</script>

<style scoped>
#nav {
  padding: 20px; /* Ajout de padding pour agrandir la barre de navigation */
  background-color: #2c3e50; /* Couleur de fond de la nav (optionnel) */
  text-align: right; /* Aligner le bouton à droite */
}

.btn-link {
  background: none;
  border: none;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
   text-decoration: none; /* Supprime le soulignement */
}

.btn-link:hover {
  color: #E67E22;
}
</style>
