<template>
  <div id="app">
    <div id="loading" v-show="isLoading"></div>
    <div style="height: 10vh">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">WMS</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'Wedding' }">
                  Wedding
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'Guest' }">
                  Guest
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'Form' }">
                  Form
                </router-link>
              </li>
              <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'User' }">
                  Profile
                </router-link>
              </li>
            </ul>
            <!-- User -->
            <div class="d-flex" v-if="isLogin">
              <strong class="userName">Hello, {{ userName }}</strong>
              <button
                type="button"
                class="btn btn-sm btn-outline-danger float-right"
                @click="logout()"
              >
                Logout
              </button>
            </div>
            <!-- Guest -->
            <div class="d-flex" v-else>
              <router-link
                tag="button"
                class="btn btn-sm btn-outline-success me-2"
                :to="{ name: 'Login' }"
              >
                Login
              </router-link>
              <router-link
                tag="button"
                class="btn btn-sm btn-outline-primary"
                :to="{ name: 'Register' }"
              >
                Register
              </router-link>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <!-- Vue Router 代入的內容 -->
    <div class="container-fluid" style="height: 90vh">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
import { apiUserLogout } from "./api";
export default {
  name: "App",
  data() {
    return {};
  },
  computed: {
    isLoading() {
      return this.$store.state.isLoading;
    },
    isLogin() {
      return this.$store.state.isLogin;
    },
    userName() {
      return this.$store.state.userName;
    }
  },
  mounted() {
    if (this.isLogin) this.$store.dispatch("getUser");
  },
  methods: {
    logout() {
      apiUserLogout()
        .then(res => {
          this.$store.commit("setLogout");
        })
        .catch(error => {});
    }
  }
};
</script>

<style lang="scss">
button {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
#loading {
  width: 100vw;
  height: 100vh;
  position: absolute;
  background: rgba(0, 0, 0, 0.1);
  z-index: 9999;
}
.userName {
  margin-right: 5px;
  line-height: 31px;
}
/***** Vue date pick *****/
.vdpComponent {
  input {
    width: 100%;
    outline: none;
    border: 0px;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
  }
}
</style>
