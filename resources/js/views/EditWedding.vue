<template>
  <div id="addWedding" class="row">
    <div class="col-10 m-auto">
      <router-link
        tag="button"
        class="btn btn-outline-info mb-2"
        :to="{ name: 'Wedding' }"
        >Back</router-link
      >
      <h2>Edit wedding</h2>
      <div class="mb-3">
        <label class="form-label">Wedding name</label>
        <input type="text" class="form-control" v-model="wedding.name" />
      </div>
      <div class="mb-3">
        <label class="form-label">Bride name</label>
        <input type="text" class="form-control" v-model="wedding.bride" />
      </div>
      <div class="mb-3">
        <label class="form-label">Bridegroom name</label>
        <input type="text" class="form-control" v-model="wedding.bridegroom" />
      </div>
      <div class="mb-3">
        <label class="form-label">Wedding date</label>
        <date-pick
          class="form-control"
          :pickTime="true"
          :format="'YYYY-MM-DD HH:mm:ss'"
          v-model="wedding.date"
        ></date-pick>
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" v-model="wedding.address" />
      </div>

      <div
        v-show="alert == 'success'"
        class="alert alert-success alert-dismissible"
        role="alert"
      >
        <strong>新增成功</strong>
        <button type="button" class="btn-close" @click="alert = ''"></button>
      </div>
      <div
        v-show="alert == 'failed'"
        class="alert alert-danger alert-dismissible"
        role="alert"
      >
        <strong>新增失敗</strong>
        <button type="button" class="btn-close" @click="alert = ''"></button>
      </div>
      <div class="text-end">
        <button
          type="button"
          class="btn btn-outline-success"
          @click="Wedding()"
        >
          Save
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import { apiGetWedding, apiEditWedding } from "../api";
export default {
  name: "EditWedding",
  data() {
    return {
      wedding: {},
      name: "",
      bride: "",
      bridegroom: "",
      address: "",
      date: "",
      alert: ""
    };
  },
  computed: {
    wedding_id() {
      return this.$route.params.wedding_id;
    }
  },
  components: {
    DatePick
  },
  created() {
    this.getWedding();
  },
  methods: {
    getWedding() {
      apiGetWedding(this.wedding_id)
        .then(res => {
          this.wedding = res.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
