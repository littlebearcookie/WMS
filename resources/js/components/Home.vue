<template>
  <div id="home">
    <div class="title">This is Home1</div>
  </div>
</template>
<script>
export default {
  name: "Home",
  mounted() {
    // this.getTodos();
  },
  methods: {
    getTodos() {
      const option = {
        method: "GET",
        headers: { myToken: "jsdifjsidjfosijdfoi1234j2i" },
        url: "http://172.16.101.119/blog/public/api/todos",
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
<style scoped lang="scss">
$titleColor: #f00;
.title {
  color: $titleColor;
}
</style>