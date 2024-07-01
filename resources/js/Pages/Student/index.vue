<!-- resources/js/Pages/Student/Index.vue -->
<template>
  <AppLayout>
    <template #content>
      <form @submit.prevent="taskStore">
        <div>
          <!-- <h1 class="text-center">Student Page</h1> -->
          <div class="container-fluid col-6 mt-5">
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
          <div class="col-8 offset-2 mt-5">
            <div class="row">
              <h1 class="text-center mb-10 font-weight-bold fs-4">Student Details</h1>
              <table class="table p-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Satuse</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(task, key) in task_list">
                    <th scope="row">{{ ++key }}</th>
                    <td>{{ task.name }}</td>
                    <td>{{ task.age }}</td>
                    <td>
                      <span class ="text-danger"  v-if="task.status == 0 ">Not Completed</span>
                      <span class="text-success" v-else>Completed</span>
                    </td>
                    <td>
                      <button
                        type="button"
                        @click="deleteTask(task.id)"
                        class="btn btn-danger"
                      ><i class="fas fa-trash "></i>

                      </button>

                  <button
                    v-if="task.status == 0"
                    type="button"
                    @click.prevent="doneTask(task.id)"
                    class="btn btn-success "
                  >
                    <i class="bi bi-check-circle "></i>
                  </button>
                  <button
                    v-if="task.status == 1"
                    type="button"
                    @click.prevent="doneTask(task.id)"
                    class="btn btn-danger"
                  >
                    <i class="bi bi-x-circle me-2"></i>
                  </button>

                      <button class="btn btn-info" type="button" @click="editTask(task.id)">update</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </form>
    </template>
    <template #modal>
      <div
        class="modal fade"
        id="taskEdit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="editModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="updateTask">
                <div>
                  <div class="mb-3">
                    <label for="modalNameInput" class="form-label">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="modalNameInput"
                      v-model="task_form.name"
                      placeholder="Name"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="modalAgeInput" class="form-label">Age</label>
                    <input
                      type="text"
                      class="form-control"
                      id="modalAgeInput"
                      placeholder="Age"
                      v-model="task_form.age"
                    />
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-info" type="submit">Save changes</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
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

      task_update_form: {
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
    async taskStore() {
      const tasks = (await axios.post(route("Student.store"), this.task_form)).data;

      this.getTask();
      this.task_form = {};
    },

    async deleteTask(id) {
      const tasks = (await axios.delete(route("student.delete", id))).data;
      this.getTask();
    },
    async doneTask(id) {
      const tasks = (await axios.get(route("student.done", id))).data;

      this.getTask();
    },
    async editTask(id) {
      console.log(id);
      const tasks = (await axios.get(route("Student.get", id))).data;
      this.task_update_form = tasks;
      $("#taskEdit").modal("show");
    },
  },
};
</script>
