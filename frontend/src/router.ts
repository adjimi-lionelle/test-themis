import Vue from 'vue';
import Router from 'vue-router';

// Import des vues
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import ListTasks from '@/views/tasks/List.vue';
import CreateTask from '@/views/tasks/Create.vue';
import EditTask from '@/views/tasks/Edit.vue';

Vue.use(Router);

// Définition du router
const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      redirect: { name: 'listTasks' } // Rediriger vers la liste des tâches par défaut
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/tasks',
      name: 'listTasks',
      component: ListTasks,
      meta: { requiresAuth: true } // Protéger la route
    },
    {
      path: '/tasks/create',
      name: 'createTask',
      component: CreateTask,
      meta: { requiresAuth: true } // Protéger la route
    },
    {
      path: '/tasks/:id/edit',
      name: 'editTask',
      component: EditTask,
      props: true, // Permet de passer `id` comme prop au composant
      meta: { requiresAuth: true } // Protéger la route
    }
  ]
});

// Navigation Guard pour protéger les routes
router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('userToken'); // Vérifier l'authentification avec le token

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'login' }); // Rediriger vers la page de connexion si non authentifié
  } else {
    next(); // Continuer vers la route demandée
  }
});

export default router;
