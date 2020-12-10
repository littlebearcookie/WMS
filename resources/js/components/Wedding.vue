<template>
  <div id="wedding" class="row">
    <div class="col-3">
      <button type="button" class="btn btn-success col-12 mb-2">+</button>
      <button
        type="button"
        class="btn col-12 mb-2"
        v-for="(wedding, index) in weddings"
        :class="{
          'btn-primary': i == index,
          'btn-outline-primary': i != index,
        }"
        :key="wedding.id"
        @click="changeWedding(index)"
      >
        {{ wedding.name }}
      </button>
    </div>
    <div class="col-9">
      <div v-if="weddings.length > 0">
        <div class="mb-3">
          <label class="form-label">Wedding name</label>
          <input type="text" class="form-control" v-model="name" />
        </div>
        <div class="mb-3">
          <label class="form-label">Bride name</label>
          <input type="text" class="form-control" v-model="bride" />
        </div>
        <div class="mb-3">
          <label class="form-label">Bridegroom name</label>
          <input type="text" class="form-control" v-model="bridegroom" />
        </div>
        <div class="mb-3">
          <label class="form-label">Wedding date</label>
          <date-pick
            class="form-control"
            :pickTime="true"
            :format="'YYYY-MM-DD HH:mm:ss'"
            v-model="date"
          ></date-pick>
        </div>
        <div class="text-right">
          <button type="button" class="btn btn-success" @click="saveWedding()">
            Save
          </button>
        </div>
      </div>
      <div v-else></div>
    </div>
  </div>
</template>
<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
export default {
  name: "Wedding",
  data() {
    return {
      weddings: [],
      i: 0,
      name: "",
      bride: "",
      bridegroom: "",
      date: "",
    };
  },
  computed: {},
  components: {
    DatePick,
  },
  mounted() {
    this.getWeddings();
  },
  methods: {
    getWeddings() {
      const option = {
        method: "GET",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("access_token"),
        },
        url: "http://172.16.101.119/demo/public/api/weddings",
      };
      this.$store.commit("loaded");
      this.axios(option)
        .then((res) => {
          this.$store.commit("loaded");
          if (res.data.data && res.data.data.length > 0) {
            this.weddings = res.data.data;
            this.name = this.weddings[this.i].name;
            this.bride = this.weddings[this.i].bride;
            this.bridegroom = this.weddings[this.i].bridegroom;
            this.date = this.weddings[this.i].date;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeWedding(index) {
      this.i = index;
      this.name = this.weddings[this.i].name;
      this.bride = this.weddings[this.i].bride;
      this.bridegroom = this.weddings[this.i].bridegroom;
      this.date = this.weddings[this.i].date;
    },
    saveWedding() {
      const option = {
        method: "PUT",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("access_token"),
        },
        url: "http://172.16.101.119/demo/public/api/weddings/" + this.weddings[this.i].id,
        data: {
          name: this.name,
          bride: this.bride,
          bridegroom: this.bridegroom,
          date: this.date,
        },
      };
      this.axios(option)
        .then((res) => {
          if (res.data.status == "ok") this.weddings[this.i].name = this.name;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    delWedding() {},
  },
};
</script>
<style scoped lang="scss">
button {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
