<template>
  <div>
    <b-table :items="accounts" :fields="account_fields">

    </b-table>
  </div>
</template>

<script>
export default {
  name: "AccountList",
  props: ["accounts"],
  data(){
    return{
      account_fields: [
        {key: 'full_name', sortable: true, label: 'Name'},
        {key: 'balance', sortable: true}
      ]
    }
  }
}
</script>