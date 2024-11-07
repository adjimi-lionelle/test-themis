// frontend/src/store/index.js

import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null, // pour stocker les informations de l'utilisateur connecté
    tasks: []   // pour stocker la liste des tâches
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TASKS(state, tasks) {
      state.tasks = tasks;
    }
  },
  actions: {
    login({ commit }, userData) {
      // Simule une action d'authentification
      commit("SET_USER", userData);
    },
    fetchTasks({ commit }, tasksData) {
      // Met à jour la liste des tâches
      commit("SET_TASKS", tasksData);
    }
  },
  getters: {
    isAuthenticated(state) {
      return !!state.user;
    },
    getUser(state) {
      return state.user;
    },
    getTasks(state) {
      return state.tasks;
    }
  }
});
