<template>
  <div id="wedding" class="row">
    <table class="table m-auto">
      <thead>
        <tr>
          <th class="text-end" colspan="5">
            <router-link
              tag="button"
              type="button"
              class="btn btn-sm btn-outline-success"
              :to="{ name: 'AddWedding' }"
            >
              Add
            </router-link>
          </th>
        </tr>
        <tr>
          <th>Name</th>
          <th>Bride</th>
          <th>Bridegroom</th>
          <th>Date</th>
          <th>Function</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="wedding in weddings" :key="wedding.id">
          <td>{{ wedding.name }}</td>
          <td>{{ wedding.bride }}</td>
          <td>{{ wedding.bridegroom }}</td>
          <td>{{ wedding.date }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-outline-warning">
              Edit
            </button>
            <button
              type="button"
              class="btn btn-sm btn-outline-danger"
              @click="delWedding(wedding.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- <div class="col-9">
      <div class="col-12 mb-2">
        <button
          type="button"
          class="btn me-1"
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
      <div class="text-end">
        <button type="button" class="btn btn-success" @click="editWedding()">
          Save
        </button>
        <button type="button" class="btn btn-danger" @click="delWedding()">
          Delete
        </button>
      </div>
    </div> -->
  </div>
</template>
<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import { apiGetWeddings, apiEditWedding, apiDelWedding } from "../api";
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
      apiGetWeddings()
        .then((res) => {
          console.log(res.data.data);
          this.weddings = res.data.data || [];
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // changeWedding(index = null) {
    //   this.i = index;
    //   this.name = this.weddings[this.i].name;
    //   this.bride = this.weddings[this.i].bride;
    //   this.bridegroom = this.weddings[this.i].bridegroom;
    //   this.date = this.weddings[this.i].date;
    // },
    // editWedding() {
    //   const data = {
    //     name: this.name,
    //     bride: this.bride,
    //     bridegroom: this.bridegroom,
    //     date: this.date,
    //   };
    //   apiEditWedding(this.weddings[this.i].id, data)
    //     .then((res) => {
    //       if (res.data.status == "ok") {
    //         this.weddings[this.i].name = this.name;
    //         this.weddings[this.i].bride = this.bride;
    //         this.weddings[this.i].bridegroom = this.bridegroom;
    //         this.weddings[this.i].date = this.date;
    //       }
    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },
    delWedding(id) {
      apiDelWedding(id)
        .then((res) => {
          if (res.data.status == "ok") this.getWeddings();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped lang="scss">
table {
  width: 90%;
  margin: auto;
}
</style>
