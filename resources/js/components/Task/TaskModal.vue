<template>
  <div>
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
  </div>
</template>

<script>
export default {
  name: "TaskModal",
  props: ["form"],
  data() {
    return {
      //checks if the form is in edit mode.
      editmode: false,

      options: [
        { value: null, text: 'Please select an option', disabled:true },
        { value: '0', text: 'Not Important' },
        { value: '1', text: 'Important' },
        { value: '2', text: 'ASAP'}
      ],
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
    }
    
  }
}
</script>