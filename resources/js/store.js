import Vue from 'vue';
// Vuex
import Vuex from 'vuex';
Vue.use(Vuex);
// axios (Vue Ajax)
import vueaxios from 'vue-axios'
import axios from 'axios'
Vue.use(vueaxios, axios)
// Vue router
import router from './router'

const store = new Vuex.Store({
  state: {
    isLoading: false,
    isLogin: (localStorage.getItem("access_token")) ? true : false,
    userName: ""
  },
  actions: {
    getUser({ commit, dispatch }) {
      const option = {
        method: "GET",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("access_token"),
        },
        url: "http://172.16.101.119/demo/public/api/profile",
      };
      axios(option)
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
      const option = {
        method: "POST",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("access_token"),
        },
        url: "http://172.16.101.119/demo/public/api/auth/refresh",
      };
      axios(option)
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
    loaded(state) {
      state.isLoading = !state.isLoading;
    }
  }

})
export default store;