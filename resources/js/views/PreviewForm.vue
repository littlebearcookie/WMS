<template>
  <div id="previewForm" class="row">
    <div class="col-sm-10 col-md-8 m-auto">
      <router-link
        tag="button"
        class="btn btn-outline-info mb-2"
        :to="{ name: 'Form' }"
        >Back</router-link
      >
      <h2 class="mb-3">{{ title }}</h2>
      <pre>{{ content }}</pre>
      <hr />
      <div v-for="(question, index) in questions" class="my-2 p-3 questionBox">
        <label class="form-label">{{ index + 1 }}. {{ question.text }}</label>
        <span v-if="question.required" class="badge bg-danger float-end"
          >必填</span
        >
        <template v-if="question.type == '1'">
          <input type="text" class="form-control" />
        </template>
        <template v-else>
          <div v-for="option in question.options" class="col-10 col-md-6 my-1">
            <div class="input-group">
              <div class="input-group-text">
                <input
                  v-if="question.type == '2'"
                  class="form-check-input"
                  type="radio"
                  :id="option.id"
                  :value="option.value"
                  v-model="replies[index].value"
                />
                <input
                  v-else-if="question.type == '3'"
                  class="form-check-input"
                  type="checkbox"
                  :id="option.id"
                  :value="option.value"
                  v-model="replies[index].value"
                />
              </div>
              <label class="form-control" :for="option.id">{{
                option.value
              }}</label>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
<script>
import { apiGetForm } from "../api";
export default {
  name: "PreviewForm",
  data() {
    return {
      title: "",
      content: "",
      questions: [],
      replies: []
    };
  },
  computed: {
    form_id() {
      return this.$route.params.form_id;
    }
  },
  watch: {
    questions(val) {
      this.replies = val.map(el => ({
        id: el.id,
        value: el.type == "3" ? [] : ""
      }));
    }
  },
  mounted() {
    this.getForm();
  },
  methods: {
    getForm() {
      apiGetForm(this.form_id)
        .then(res => {
          this.title = res.data.data.title;
          this.content = res.data.data.content;
          this.questions = res.data.data.questions;
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
