<template>
  <div class="row justify-content-center">
    <div class="container col-md-8">
      <h1>Loan Request</h1>
      <hr>

      <h4>Approved Requests</h4>
      <b-table :items="loan_request" :fields="loan_fields" show-empty="" bordered responsive="sm" filter="Approved" :filter-debounce="0">
        <template v-slot:cell(employee_name)="data">
          {{ `${data.item.first_name} ${data.item.last_name}`}}
        </template>
        <template v-slot:cell(amount)="data">
          {{ data.item.amount | currency }}
        </template>
         <template v-slot:cell(action)="data">
          <b-button-group>
            <b-dropdown right split text="Approve" variant="primary" @click="$emit('approve-loan', data.item.id)">
              <b-dropdown-item @click="$emit('decline-loan', data.item.id)">Decline</b-dropdown-item>
              <b-dropdown-divider></b-dropdown-divider>
              <b-dropdown-item>View</b-dropdown-item>
            </b-dropdown>
          </b-button-group>
        </template>
      </b-table>

      <h4>Pending Requests</h4>
       <b-table :items="loan_request" :fields="loan_fields" show-empty="" bordered responsive="sm" filter="Pending" :filter-debounce="0">
        <template v-slot:cell(employee_name)="data">
          {{ `${data.item.first_name} ${data.item.last_name}`}}
        </template>
        <template v-slot:cell(amount)="data">
          {{ data.item.amount | currency }}
        </template>
         <template v-slot:cell(action)="data">
          <b-button-group>
            <b-dropdown right split text="Approve" variant="primary" @click="$emit('approve-loan', data.item.id)">
              <b-dropdown-item @click="$emit('decline-loan', data.item.id)">Decline</b-dropdown-item>
              <b-dropdown-divider></b-dropdown-divider>
              <b-dropdown-item>View</b-dropdown-item>
            </b-dropdown>
          </b-button-group>
        </template>
      </b-table>

      <h4>Declined Requests</h4>
       <b-table :items="loan_request" :fields="loan_fields" show-empty="" bordered responsive="sm" filter="Declined" :filter-debounce="0">
        <template v-slot:cell(employee_name)="data">
          {{ `${data.item.first_name} ${data.item.last_name}`}}
        </template>
        <template v-slot:cell(amount)="data">
          {{ data.item.amount | currency }}
        </template>
         <template v-slot:cell(action)="data">
          <b-button-group>
            <b-dropdown right split text="Approve" variant="primary" @click="$emit('approve-loan', data.item.id)">
              <b-dropdown-item @click="$emit('decline-loan', data.item.id)">Decline</b-dropdown-item>
              <b-dropdown-divider></b-dropdown-divider>
              <b-dropdown-item>View</b-dropdown-item>
            </b-dropdown>
          </b-button-group>
        </template>
      </b-table>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoanList",
  props: ["loan_request"],
  data(){
    return{
      loan_fields: [
        {key: 'created_at', sortable: true, label: 'Submitted at'},
        {key: 'employee_name', sortable: true},
        {key: 'amount', sortable: true},
        {key: 'mode_of_transfer', sortable: true},
        {key: 'repayment_option', sortable: true},
        {key: 'approval', sortable: true},
        {key: 'action'},
      ]
    }
  },
  methods:{
   
  }
}
</script>