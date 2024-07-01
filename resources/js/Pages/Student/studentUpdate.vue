<template>
  <AppLayout>
    <template #content>
      <form @submit.prevent="taskStore">
        <div>
          <h1 class="text-center">Student Page</h1>
          <div class="container-fluid col-6">
            <div class="row">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >first Name</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  v-model="task_form.name"
                  placeholder="Name"
                />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">age</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Age"
                  v-model="task_form.age"
                />
              </div>
              <div class="mb-3">
                <button class="btn btn-info" type="submit">submit</button>
              </div>
            </div>
          </div>


        </div>
      </form>
    </template>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import axios from "axios";

export default {
  components: {
    AppLayout,
  },

  data() {
    return {
      task_form: {
        name: "",
        age: "",
      },
      task_list: [],
    };
  },
  beforeMount() {
    this.getTask();
  },

  methods: {
    async getTask() {
      const tasks = (await axios.get(route("Student.list"))).data;
      this.task_list = tasks;
    },
    
    async updateStudent(id) {
      const tasks = (await axios.get(route("student.done", id))).data;

      this.getTask();
    },


  },
};
</script>
