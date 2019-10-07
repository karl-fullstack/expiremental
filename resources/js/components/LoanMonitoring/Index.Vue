<template>
    <div class="container-fluid">
        <router-link to="/employee_table">Employee Records</router-link>
        <AccountList :accounts="accounts"/>
    </div>
</template>

<script>
    import Swal from "sweetalert2";
    import Form from "vform";
    import AccountList from "./Accounts/AccountList.vue"
    export default {
      components : {
        AccountList
      },
      data(){
        return{
          accounts: [],
        }
      },
      methods:{
        fetchAccounts(){
          axios.get('/api/pay_account')
            .then(res => this.accounts = res.data)
            .catch();
        }
      },
      created(){
        this.fetchAccounts();
      }
    }
</script>
