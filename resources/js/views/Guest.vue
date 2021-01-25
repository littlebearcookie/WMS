<template>
  <div id="participant" class="row">
    <div class="col-3">
      <!-- <button
        tag="button"
        class="btn col-12 mb-2"
        v-for="wedding in weddings"
        :class="{
          'btn-outline-primary': true,
          active: wedding.id === wedding_id,
        }"
        :key="wedding.id"
        @click="wedding_id = wedding.id"
      >
        {{ wedding.name }}
      </button> -->
      <router-link
        tag="button"
        class="btn col-12 mb-2"
        v-for="wedding in weddings"
        :class="{
          'btn-outline-primary': true,
          active: wedding.id === wedding_id
        }"
        :key="wedding.id"
        :to="{ name: 'Guest', params: { wedding_id: wedding.id } }"
      >
        {{ wedding.name }}
      </router-link>
    </div>
    <div class="col-9">
      <table>
        <thead>
          <tr>
            <th>
              <button type="button" class="btn btn-sm btn-success">Add</button>
            </th>
          </tr>
          <tr>
            <th>Name</th>
            <th>Function</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</template>
<script>
import { apiGetWeddings, apiGetGuests } from "../api";
export default {
  name: "Guest",
  data() {
    return {
      weddings: [],
      guests: []
    };
  },
  mounted() {
    this.init();
    // this.getGuests();
  },
  computed: {
    wedding_id: {
      get() {
        return parseInt(this.$route.params.wedding_id);
      },
      set(val) {
        console.log(val);
        return val;
      }
    }
  },
  methods: {
    async init() {
      await apiGetWeddings()
        .then(res => {
          this.weddings = res.data.data || [];
        })
        .catch(error => {
          console.log(error);
        });
      if (this.wedding_id) {
        await apiGetGuests(this.wedding_id)
          .then(res => {
            console.log(res);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    getGuests() {
      apiGetGuests()
        .then(res => {
          this.weddings = res.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
