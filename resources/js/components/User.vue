<template>
  <div id="user">Hello, {{ name }}</div>
</template>
<script>
export default {
  name: "User",
  data() {
    return {};
  },
  computed: {
    name() {
      return this.$store.state.userName;
    },
  },
  mounted() {
    this.$store.dispatch("getUser");
  },
};
</script>
<style scoped lang="scss"></style>
