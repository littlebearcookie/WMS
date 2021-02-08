<template>
  <div id="guest" class="row">
    <div class="col-3">
      <button
        type="button"
        class="btn col-12 mb-2"
        :class="{
          'btn-outline-primary': true,
          active: wedding_id === null
        }"
        @click="wedding_id = null"
      >
        All
      </button>
      <button
        type="button"
        class="btn col-12 mb-2"
        v-for="wedding in weddings"
        :class="{
          'btn-outline-primary': true,
          active: wedding.id === wedding_id
        }"
        :key="wedding.id"
        @click="wedding_id = wedding.id"
      >
        {{ wedding.name }}
      </button>
    </div>
    <div class="col-9">
      <table class="table m-auto">
        <thead>
          <tr>
            <th class="text-end" colspan="2">
              <button
                type="button"
                class="btn btn-sm btn-outline-success"
                @click="addGuest()"
              >
                Add
              </button>
            </th>
          </tr>
          <tr>
            <th class="col-md-8 col-6">Name</th>
            <th class="col-md-4 col-6">Function</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="guest in filterGuests" :key="guest.id">
            <td>{{ guest.name }}</td>
            <td>
              <button
                type="button"
                class="btn btn-sm btn-outline-warning"
                @click="editGuest(guest)"
              >
                Edit
              </button>
              <button
                type="button"
                class="btn btn-sm btn-outline-danger"
                @click="delGuest(guest.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <AddGuestModal :weddings="weddings" @refresh="getGuests()"></AddGuestModal>
    <EditGuestModal
      :weddings="weddings"
      :guest_info="guest_info"
      @refresh="getGuests()"
    ></EditGuestModal>
  </div>
</template>
<script>
import AddGuestModal from "../components/AddGuestModal.vue";
import EditGuestModal from "../components/EditGuestModal.vue";
import { apiGetWeddings, apiGetGuests, apiDelGuest } from "../api";
import { Modal } from "bootstrap";
export default {
  name: "Guest",
  data() {
    return {
      weddings: [],
      wedding_id: null,
      guests: [],
      guest_info: {},
      modal: {
        addGuest: null,
        editGuest: null
      }
    };
  },
  components: {
    AddGuestModal: AddGuestModal,
    EditGuestModal: EditGuestModal
  },
  computed: {
    filterGuests() {
      if (this.wedding_id)
        return this.guests.filter(guest => guest.wedding_id == this.wedding_id);
      else return this.guests;
    }
  },
  mounted() {
    this.init();
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
      await apiGetGuests()
        .then(res => {
          this.guests = res.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getGuests() {
      apiGetGuests()
        .then(res => {
          this.guests = res.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    addGuest() {
      this.modal.addGuest = new Modal(
        document.getElementById("addGuestModal"),
        {
          backdrop: "static",
          keyboard: false
        }
      );
      this.modal.addGuest.toggle();
    },
    editGuest(info) {
      this.guest_info = {
        id: info.id,
        wedding_id: info.wedding_id,
        name: info.name
      };
      this.modal.editGuest = new Modal(
        document.getElementById("editGuestModal"),
        {
          backdrop: "static",
          keyboard: false
        }
      );
      this.modal.editGuest.toggle();
    },
    delGuest(id) {
      apiDelGuest(id)
        .then(res => {
          this.getGuests();
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
<style scoped lang="scss"></style>
