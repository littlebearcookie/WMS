<template>
  <div class="row h-100 align-items-center justify-content-center">
    <div class="col-sm-8 col-md-6">
      <div class="mb-3 row">
        <label for="email" class="col-4 col-form-label">Email</label>
        <div class="col-8">
          <input type="email" class="form-control" id="email" v-model="email" />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="password" class="col-4 col-form-label">Password</label>
        <div class="col-8">
          <input type="password" class="form-control" id="password" v-model="password" />
        </div>
      </div>
      <div
        v-show="alert == 'failed'"
        class="alert alert-danger alert-dismissible"
        role="alert"
      >
        <strong>登入失敗</strong>
        <button type="button" class="btn-close" @click="alert = ''"></button>
      </div>
      <button type="button" class="btn btn-success col-12" @click="login()">Login</button>
    </div>
  </div>
</template>

<script>
import { apiUserLogin } from "../api";
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      alert: "",
    };
  },
  methods: {
    login() {
      const data = {
        email: this.email,
        password: this.password,
      };
      apiUserLogin(data)
        .then((res) => {
          this.$store.commit("setLogin", res.data.access_token);
        })
        .catch((error) => {
          this.alert = "failed";
        });
    },
  },
};
</script>
