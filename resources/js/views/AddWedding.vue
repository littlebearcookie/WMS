<template>
  <div id="addWedding" class="row">
    <div class="col-10 m-auto">
      <h2>Add wedding</h2>
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
      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" v-model="address" />
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
          @click="addWedding()"
        >
          Add
        </button>
        <button type="button" class="btn btn-outline-primary">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import { apiAddWedding } from "../api";
export default {
  name: "AddWedding",
  data() {
    return {
      name: "",
      bride: "",
      bridegroom: "",
      address: "",
      date: "",
      alert: ""
    };
  },
  computed: {},
  components: {
    DatePick
  },
  mounted() {},
  methods: {
    addWedding() {
      const data = {
        name: this.name,
        bride: this.bride,
        bridegroom: this.bridegroom,
        address: this.address,
        date: this.date
      };
      apiAddWedding(data)
        .then(res => {
          this.$router.push({ name: "Wedding" });
        })
        .catch(error => {
          this.alert = "failed";
        });
    }
  }
};
</script>
