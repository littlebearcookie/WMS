<template>
  <div id="addForm" class="row">
    <div class="col-sm-10 col-md-8 m-auto">
      <div>
        <h2 style="display:inline">Form</h2>
        <button
          v-for="type in types"
          :key="type.id"
          class="btn btn-outline-primary me-1"
          @click="addQuestion(type.id)"
        >
          {{ type.name }}
        </button>
        <button type="button" class="btn btn-success" @click="saveForm()">
          Save
        </button>
      </div>
      <div class="mb-2">
        <label class="form-label">Title</label>
        <input
          type="text"
          placeholder="表單標題"
          class="form-control"
          v-model="title"
        />
      </div>
      <div class="mb-2">
        <label class="form-label">Content</label>
        <textarea
          placeholder="表單內容"
          class="form-control"
          v-model="content"
        ></textarea>
      </div>
      <div v-for="(question, index) in questions" class="my-2 p-3 questionBox">
        <label class="form-label">Question{{ index }}</label>
        <input
          type="text"
          placeholder="問題內容"
          class="form-control"
          v-model="question.text"
        />
        <template v-if="question.type != '1'">
          <div
            v-for="(option, index) in question.options"
            class="col-10 col-md-6 my-1"
          >
            <div class="input-group">
              <div class="input-group-text">
                <input
                  v-if="question.type == '2'"
                  class="form-check-input"
                  type="radio"
                  disabled
                />
                <input
                  v-else-if="question.type == '3'"
                  class="form-check-input"
                  type="checkbox"
                  disabled
                />
              </div>
              <input
                type="text"
                placeholder="選項內容"
                class="form-control"
                v-model="option.value"
              />
              <button
                v-if="index > 0"
                class="btn btn-outline-danger"
                type="button"
                @click="question.options.splice(index, 1)"
              >
                Delete
              </button>
            </div>
          </div>
          <button
            type="button"
            class="btn btn-sm btn-outline-success col-10 col-md-6"
            @click="addOption(index)"
          >
            +
          </button>
        </template>
        <hr />
        <div>
          <button type="button" class="btn btn-sm">必填</button>
          <div class="btn-group btn-group-sm">
            <button
              type="button"
              class="btn btn-outline-primary"
              :class="{ active: question.required == true }"
              @click="question.required = true"
            >
              Yes
            </button>
            <button
              type="button"
              class="btn btn-outline-primary"
              :class="{ active: question.required == false }"
              @click="question.required = false"
            >
              No
            </button>
          </div>
          <button
            class="btn btn-sm btn-outline-danger float-end"
            @click="delQuestion(index)"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { apiGetForm, apiEditForm } from "../api";
export default {
  name: "Question",
  data() {
    return {
      title: "",
      content: "",
      questions: [],
      types: [
        { id: "1", name: "文字" },
        { id: "2", name: "單選" },
        { id: "3", name: "多選" }
      ]
    };
  },
  computed: {
    form_id() {
      return this.$route.params.form_id;
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
    },
    addQuestion(type) {
      var options = type === "1" ? [] : [{ value: "" }];
      var question = {
        required: false,
        text: "",
        type: type,
        options: options
      };
      this.questions.push(question);
    },
    delQuestion(index) {
      this.questions.splice(index, 1);
    },
    addOption(index) {
      this.questions[index].options.push({ value: "" });
    },
    saveForm() {
      var data = {
        title: this.title,
        content: this.content,
        questions: this.questions
      };
      apiEditForm(this.form_id, data)
        .then(res => {
          this.$router.push({ name: "Form" });
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
<style scope lang="scss">
.questionBox {
  border: 1px solid #aaa;
  border-radius: 8px;
}
textarea {
  resize: none;
}
</style>
