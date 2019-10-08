<template>
  <div class="row justify-content-center">
    <div class="container col-md-8">
      <h1>Loan Approved</h1>
      <hr>

      <h4>Approved Requests</h4>
      <b-table :items="loan_approved" :fields="loan_fields" show-empty="" bordered responsive="sm" >
        <!-- <template v-slot:cell(employee_name)="data">
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
        </template> -->
      </b-table>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return{
      loan_approved: [],
      loan_fields: [
        {key: 'id'},
        {key: 'created_at', label: 'Approved at'},
        {key: 'loan_request_id'},
        {key: 'release_date'},
        {key: 'maturity_date'},
        {key: 'status'},
      ]
    }
  },
  methods: {
    fetchLoanApproved(){
      axios.get('api/loan_approved')
      .then( res => this.loan_approved = res.data)
      .catch()
    }
  },
  created(){
    this.fetchLoanApproved();
  }
}
</script>