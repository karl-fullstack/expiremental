<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-5">
                    <!-- <b-form @submit="createTask">
                        <b-form-group
                            id="input-group-1"
                            label="Title:"
                            label-for="input-1"
                        >
                            <b-form-input id="input-1" v-model="form.title" type="text" required></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="input-group-3"
                            label="Priority Rate:"
                            label-for="input-3"
                        >
                             <b-form-select :options="options" v-model="form.priority_rate" required></b-form-select>
                        </b-form-group>
                        <b-button variant="primary" type="submit">Submit</b-button>
                    </b-form>
                    <br> -->
                    <b-button variant="primary" @click="createTaskModal(), editmode=false">Create Task</b-button>
                </div>
                
                <TaskList :task="task" @load-task="loadSpecificTask" />

            </div>
        </div>

        <!-- start: Create/Edit Task Modal -->
        <b-modal id="task_modal" size="sm" hide-footer>
          <template v-slot:modal-title>
            <div v-if="editmode">Edit Task</div>
            <div v-else>Create Task</div>
          </template>
          <b-form>
              <b-form-group
                  id="input-group-1"
                  label="Title:"
                  label-for="input-1"
              >
                  <b-form-input id="input-1" v-model="form.title" type="text" required></b-form-input>
              </b-form-group>
              <b-form-group
                  id="input-group-3"
                  label="Priority Rate:"
                  label-for="input-3"
              >
                    <b-form-select :options="options" v-model="form.priority_rate" required></b-form-select>
              </b-form-group>
              <b-button v-show="editmode" variant="primary"  @click="updateTask">Submit</b-button>
              <b-button v-show="!editmode" variant="primary"  @click="createTask">Submit</b-button>
          </b-form>
        </b-modal>
        <!-- end: Create/Edit Task Modal -->


    </div>
</template>

<script>
    import Swal from "sweetalert2";
    import Form from "vform";
    import TaskList from "./TaskList";

    export default {
        name: "task",
        components: {
          TaskList,
        },
        data(){
            return{
                //checks if the form is in edit mode.
                editmode: false,
                
                // This is the array that will hold the list of task
                task: [],

                // Variable that will hold the form model
                form: new Form ({
                    id:'',
                    title: '',
                    status: '',
                    priority_rate: '',
                }),

                // Options for priority rate select form
                options: [
                    { value: null, text: 'Please select an option', disabled:true },
                    { value: '0', text: 'Not Important' },
                    { value: '1', text: 'Important' },
                    { value: '2', text: 'ASAP'}
                ]
            }
            
        },
        methods:{
            loadTask(){
                axios.get('/api/tasks').then(({data}) => (this.task = data));
            },
            loadSpecificTask(task){
                this.form.fill(task);
                this.editmode = true;
            },
            createTask(){
                this.form.post('/api/tasks')
                    .then(
                      Fire.$emit('AfterCreate'),
                      this.$bvModal.hide('task_modal'),
                      Swal.fire({
                        title: 'Created!',
                        text: 'A task has been created!',
                        type: 'success',
                        confirmButtonText: 'Close'
                      })
                    ).catch();
            },
            updateTask(){
                this.form.patch('/api/tasks/'+this.form.id)
                    .then(
                      Fire.$emit('AfterCreate'),
                      this.$bvModal.hide('task_modal'),
                      Swal.fire({
                        title: 'Updated!',
                        text: 'Your Data has been updated!',
                        type: 'success',
                        confirmButtonText: 'Close'
                      })
                      // this.$swal('Your Task has been updated!'),
                    ).catch();
            },
            createTaskModal(){
              this.$bvModal.show('task_modal'),
              this.form.reset()
            }
        },
        created() {
            this.loadTask();
            Fire.$on('AfterCreate',() =>{
                this.loadTask();
            });
        },
    }
</script>
