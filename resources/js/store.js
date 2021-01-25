import Vue from 'vue';
// Vuex
import Vuex from 'vuex';
Vue.use(Vuex);
// Vue router
import router from './router'
import { apiUserProfile, apiUserRefresh } from './api'

const store = new Vuex.Store({
  state: {
    isLoading: false,
    isLogin: (localStorage.getItem("access_token")) ? true : false,
    userName: ""
  },
  actions: {
    getUser({ commit, dispatch }) {
      apiUserProfile()
        .then((res) => {
          commit("setUserName", res.data.name);
        })
        .catch((error) => {
          if (error.response.status) {
            if (error.response.status == 401) {
              dispatch("refreshToken");
            }
          }
        });
    },
    refreshToken({ commit }) {
      apiUserRefresh({})
        .then((res) => {
          localStorage.setItem("access_token", res.data.access_token);
        })
        .catch((error) => {
          if (error.response.status) {
            if (error.response.status == 401) {
              commit("setLogout");
            }
          }
        });
    }
  },
  mutations: {
    setLogin(state, payload) {
      localStorage.setItem("access_token", payload);
      state.isLogin = true;
      router.push({ name: "User" });
    },
    setLogout(state) {
      localStorage.removeItem("access_token");
      state.isLogin = false;
      router.push({ name: "Login" });
    },
    setUserName(state, payload) {
      state.userName = payload;
    },
    loaded(state, payload) {
      state.isLoading = payload;
    }
  }

})
export default store;