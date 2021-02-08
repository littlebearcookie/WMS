<template>
  <div id="wedding" class="row">
    <table class="table m-auto">
      <thead>
        <tr>
          <th class="text-end" colspan="5">
            <router-link
              tag="button"
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
            <router-link
              tag="button"
              class="btn btn-sm btn-outline-warning"
              :to="{ name: 'EditWedding', params: { wedding_id: wedding.id } }"
            >
              Edit
            </router-link>
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
  </div>
</template>
<script>
import { apiGetWeddings, apiDelWedding } from "../api";
export default {
  name: "Wedding",
  data() {
    return {
      weddings: []
    };
  },
  computed: {},
  mounted() {
    this.getWeddings();
  },
  methods: {
    getWeddings() {
      apiGetWeddings()
        .then(res => {
          this.weddings = res.data.data || [];
        })
        .catch(error => {
          console.log(error);
        });
    },
    delWedding(id) {
      apiDelWedding(id)
        .then(res => {
          if (res.data.status == "ok") this.getWeddings();
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
<style scoped lang="scss">
table {
  width: 90%;
  margin: auto;
}
</style>
