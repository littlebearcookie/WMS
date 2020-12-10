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
      <div class="mb-3 row">
        <label for="name" class="col-4 col-form-label">Name</label>
        <div class="col-8">
          <input type="text" class="form-control" id="name" v-model="name" />
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-4 col-form-label">Sex</label>
        <div class="col-8 col-form-label">
          <label class="radio-inline" for="sex_man">
            <input
              type="radio"
              class="mr-1"
              name="sex"
              id="sex_man"
              value="man"
              v-model="sex"
            />Man
          </label>
          <label class="radio-inline" for="sex_girl">
            <input
              type="radio"
              class="mr-1"
              name="sex"
              id="sex_girl"
              value="girl"
              v-model="sex"
            />Girl
          </label>
        </div>
      </div>
      <button type="button" class="btn btn-primary col-12" @click="register()">
        Register
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      email: "",
      password: "",
      name: "",
      sex: "man",
    };
  },
  methods: {
    register() {
      // console.log({
      //   email: this.email,
      //   pwd: this.password,
      //   name: this.name,
      //   sex: this.sex,
      // });
      const option = {
        method: "POST",
        url: "http://172.16.101.119/demo/public/api/auth/register",
        data: {
          name: this.name,
          email: this.email,
          password: this.password,
        },
      };
      this.axios(option)
        .then((res) => {
          console.log(res);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped lang="scss"></style>
