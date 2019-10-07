<template>
  <div>
    <div class="card mt-5">   
      <b-table striped hover :items="task" :fields="fields">
          <template v-slot:cell(priority_rate)="data">
            <div v-if="data.item.priority_rate==0"> <b-badge variant="secondary">Not Important</b-badge></div>
            <div v-else-if="data.item.priority_rate==1"> <b-badge variant="primary">Important</b-badge></div>
            <div v-else-if="data.item.priority_rate==2"> <b-badge variant="danger">ASAP</b-badge></div>
            <div v-else></div>
          </template>
          <template v-slot:cell(action)="data">
              <b-button variant="primary" v-b-modal.task_modal @click="getTask(data.item)"><i class="fas fa-edit"></i></b-button>
              <b-button variant="danger" @click="deleteTask(data.item.id)">Delete</b-button>
          </template>
      </b-table>
    </div>
  </div>
</template>

<script>
export default {
  name: "TaskList",
  props: ["task"],
  data (){
    return {
      // This is the fields for the table
      fields: [ 
          {key:"title", sortable: true},
          {key:'status', sortable: true},
          {key:'priority_rate', sortable: true},
          {key:'action'},
      ],
    }
  },
  methods: {
    getTask(task) {
      const calledTask = task
      this.$emit('load-task', calledTask)
    },
    deleteTask(id){
      axios.delete(`/api/tasks/${id}`)
            .then(Fire.$emit('AfterCreate'))
            .catch();
    },
  }
}
</script>