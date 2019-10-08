<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>Payroll Records</h1>

        <b-form-group
          id="input-group-1"
          label=""
          label-for="input-1"
          description="."
        >
          <b-input-group size="sm">
          <b-form-input
            id="input-1"
            v-model="table_filter"
            type="search"
            required
            placeholder="Search"
          ></b-form-input>
          <b-input-group-append>
            <b-button :disabled="!table_filter" @click="table_filter = ''">Clear</b-button>
          </b-input-group-append>
          </b-input-group>
        </b-form-group>



        <b-table 
          :items="payroll" 
          :fields="payroll_field" 
          :sort-by.sync="sortBy"
          :sort-desc.sync="sortDesc"
          show-empty=""
          sort-icon-left      
          responsive="sm"
          :filter="table_filter"
          :filter-debounce="0"
          bordered
        >

          <template  v-slot:cell(netpay)="data">
            {{ data.item.netpay | currency }}
          </template>

          <template v-slot:cell(action)="data">
            <b-button size="sm" @click="data.toggleDetails" class="mr-2">
              {{ data.detailsShowing ? 'Hide' : 'Show'}} Details
            </b-button>
          </template>

          <template v-slot:row-details="data">
            <b-card>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b>Basic Pay:</b></b-col>
                <b-col>{{ data.item.basic_pay | currency }}</b-col>
                <b-col sm="2" class="text-sm-right"><b>SSS:</b></b-col>
                <b-col>-{{ data.item.sss | currency }}</b-col>
              </b-row>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b>Overtime:</b></b-col>
                <b-col>{{ data.item.overtime_pay | currency }} (Approx. {{ data.item.overtime_hours}} Hours)</b-col>
                <b-col sm="2" class="text-sm-right"><b>Philhealth:</b></b-col>
                <b-col>-{{ data.item.philhealth | currency }}</b-col>
              </b-row>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b>Incentives:</b></b-col>
                <b-col>{{ data.item.incentives | currency }} </b-col>
                <b-col sm="2" class="text-sm-right"><b>Pag-ibig:</b></b-col>
                <b-col>-{{ data.item.pagibig | currency }}</b-col>
              </b-row>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b></b></b-col>
                <b-col></b-col>
                <b-col sm="2" class="text-sm-right"><b>Absence / Lates:</b></b-col>
                <b-col>-{{ data.item.absence_late | currency }} (Approx. {{ data.item.absence_late_hours}} Hours)</b-col>
              </b-row>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b></b></b-col>
                <b-col></b-col>
                <b-col sm="2" class="text-sm-right"><b>Deductions:</b></b-col>
                <b-col>-{{ data.item.deductions | currency }}</b-col>
              </b-row>
              <hr/>
              <b-row class="mb-2">
                <b-col sm="2" class="text-sm-right"><b>Total:</b></b-col>
                <b-col>{{ data.item.basic_pay +  data.item.overtime_pay + data.item.incentives | currency }}</b-col>
                <b-col sm="2" class="text-sm-right"><b>Total:</b></b-col>
                <b-col>-{{ data.item.deductions + data.item.absence_late + data.item.pagibig + data.item.philhealth + data.item.sss | currency }}</b-col>
              </b-row>



              
            </b-card>
          </template>

        </b-table>
      </div>
    </div>  
  </div>
</template>

<script>
    import Swal from "sweetalert2";
    import Form from "vform";
    export default {
      components : {
      },
      data(){
        return{
          payroll: [],
          payroll_field: [
            {key: 'created_at', sortable: true},
            {key: 'first_name', sortable: true},
            {key: 'last_name', sortable: true},
            {key: 'netpay', sortable: true},
            {key: 'action'},
          ],
          sortBy: 'created_at',
          sortDesc: true,
          table_filter: '',
        }
      },
      filters:{
        // currencyx (){
        //   return value.
        // }
      },
      methods:{
        fetchPayroll(){
          axios.get('/api/payroll')
            .then(res => this.payroll = res.data)
            .catch();
        }
      },
      created(){
        this.fetchPayroll();
      }
    }
</script>