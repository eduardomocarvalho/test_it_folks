// import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'



export const initialStore = new Vuex.Store({
  plugins: [createPersistedState({
    key: 'initial'
  })],
  state: {
    auth_token: null,
    user: null
  },
  getters: {
    auth_token: state => {
      return state.auth_token;
    },
    user: state => {
      return state.user
    }
  },
  mutations: {
    setAuthToken: (state, payload) => {
      state.auth_token = payload;
    },
    setUser: (state, payload) => {
      state.user = payload;
    },
  },
  actions: {
    logout: () => {

    }, 
  }
});