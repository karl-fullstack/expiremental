<template>
    <div class="container-fluid">
      <div class="mb-2">
        <router-link to="/employee_table" class="btn btn-primary"> <i class="fas fa-list-alt"></i> Employee Records</router-link>
        <router-link to="/payroll" class="btn btn-primary"> <i class="fas fa-money-bill"></i> Payroll</router-link>
        <router-link to="/loan_approved" class="btn btn-success"> <i class="fas fa-landmark"></i> Loans</router-link>
      </div>

        <LoanList 
          :loan_request="loan_request" 
          v-on:approve-loan="approveLoan" 
          v-on:decline-loan="declineLoan"
        />

    </div>
</template>

<script>
    import LoanList from "./LoanRequests/LoanList.vue"
    export default {
      components : {
        LoanList
      },
      data(){
        return{
          loan_request: [],
        }
      },
      methods:{
        fetchLoanRequests(){
          axios.get('/api/loan_request')
            .then(res => this.loan_request = res.data)
            .catch();
        },
        approveLoan(id) {
          axios.put(`api/loan_request/${id}?q=approve`)
          .then(
            this.$swal.fire(
              'Success',
              'Approved loan request',
              'success'
            ).then(
              this.fetchLoanRequests()
            )
            .catch()
          )
          .catch( error =>
              this.$swal.fire(
              'Error',
              $res.error,
              'error')
          )
        },
        declineLoan(id) {
          axios.put(`api/loan_request/${id}?q=decline`)
          .then(
            this.$swal.fire(
              'Success',
              'You declined a loan request',
              'warning'
            ).then(
              this.fetchLoanRequests()
            )
            .catch()
            
          )
          .catch()
        }
      },
      created(){
        this.fetchLoanRequests();
      }
    }
</script>
