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
          <input
            type="password"
            class="form-control"
            id="password"
            v-model="password"
          />
        </div>
      </div>
      <div
        v-show="login_failed"
        class="alert alert-danger alert-dismissible"
        role="alert"
      >
        <strong>登入失敗</strong>
        <button
          type="button"
          class="btn-close"
          @click="login_failed = false"
        ></button>
      </div>
      <button type="button" class="btn btn-success col-12" @click="login()">
        Login
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      login_failed: false,
    };
  },
  methods: {
    login() {
      const option = {
        method: "POST",
        url: "http://172.16.101.119/demo/public/api/auth/login",
        data: {
          email: this.email,
          password: this.password,
        },
      };
      this.axios(option)
        .then((res) => {
          this.$store.commit("setLogin", res.data.access_token);
        })
        .catch((error) => {
          this.login_failed = true;
        });
    },
  },
};
</script>
<style scoped lang="scss"></style>
