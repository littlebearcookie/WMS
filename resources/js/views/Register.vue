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
      <div class="mb-3 row">
        <label for="name" class="col-4 col-form-label">Name</label>
        <div class="col-8">
          <input type="text" class="form-control" id="name" v-model="name" />
        </div>
      </div>
      <!-- Alert -->
      <div
        v-show="alert == 'success'"
        class="alert alert-success alert-dismissible"
        role="alert"
      >
        <strong>註冊成功</strong>
        <button type="button" class="btn-close" @click="alert = ''"></button>
      </div>
      <div
        v-show="alert == 'failed'"
        class="alert alert-danger alert-dismissible"
        role="alert"
      >
        <strong>註冊失敗</strong>
        <button type="button" class="btn-close" @click="alert = ''"></button>
      </div>
      <button type="button" class="btn btn-primary col-12" @click="register()">
        Register
      </button>
    </div>
  </div>
</template>

<script>
import { apiUserRegister } from "../api";
export default {
  name: "Register",
  data() {
    return {
      email: "",
      password: "",
      name: "",
      alert: "",
    };
  },
  methods: {
    register() {
      const data = {
        name: this.name,
        email: this.email,
        password: this.password,
      };
      apiUserRegister(data)
        .then((res) => {
          if (res.data.message == "Successfully registered") {
            this.alert = "success";
            this.name = "";
            this.email = "";
            this.password = "";
          } else this.alert = "failed";
        })
        .catch((error) => {
          this.alert = "failed";
        });
    },
  },
};
</script>
