<template>
  <div id="addGuestModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">新增賓客</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Wedding</label>
            <div class="col-sm-10">
              <select class="form-select" v-model="wedding_id">
                <option v-for="wedding in weddings" :value="wedding.id">
                  {{ wedding.name }}
                </option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" v-model="name" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-success"
            @click="addGuest()"
          >
            Add
          </button>
          <button
            type="button"
            class="btn btn-outline-secondary"
            data-bs-dismiss="modal"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { apiAddGuest } from "../api";
export default {
  name: "AddGuestModal",
  data() {
    return {
      wedding_id: "",
      name: ""
    };
  },
  props: {
    weddings: {
      type: Array
    }
  },
  watch: {
    weddings(val) {
      this.wedding_id = val[0].id;
    }
  },
  methods: {
    addGuest() {
      var data = {
        wedding_id: this.wedding_id,
        name: this.name
      };
      apiAddGuest(data)
        .then(res => {
          this.$parent.modal.addGuest.hide();
          this.$emit("refresh");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
<style scope lang="scss"></style>
