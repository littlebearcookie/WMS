<template>
  <div id="form" class="row">
    <table class="table m-auto">
      <thead>
        <tr>
          <th class="text-end" colspan="5">
            <router-link
              tag="button"
              class="btn btn-sm btn-outline-success"
              :to="{ name: 'AddForm' }"
            >
              Add
            </router-link>
          </th>
        </tr>
        <tr>
          <th class="col-md-8 col-6">Title</th>
          <th class="col-md-4 col-6">Function</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="form in forms" :key="form.id">
          <td>{{ form.title }}</td>
          <td>
            <router-link
              tag="button"
              class="btn btn-sm btn-outline-primary"
              :to="{ name: 'PreviewForm', params: { form_id: form.id } }"
            >
              View
            </router-link>
            <router-link
              tag="button"
              class="btn btn-sm btn-outline-warning"
              :to="{ name: 'EditForm', params: { form_id: form.id } }"
            >
              Edit
            </router-link>
            <button
              type="button"
              class="btn btn-sm btn-outline-danger"
              @click="delForm(form.id)"
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
import { apiGetForms, apiDelForm } from "../api";
export default {
  name: "Form",
  data() {
    return {
      forms: []
    };
  },
  computed: {},
  mounted() {
    this.getForms();
  },
  methods: {
    getForms() {
      apiGetForms()
        .then(res => {
          this.forms = res.data.data || [];
        })
        .catch(error => {
          console.log(error);
        });
    },
    delForm(id) {
      apiDelForm(id)
        .then(res => {
          if (res.data.status == "ok") this.getForms();
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
