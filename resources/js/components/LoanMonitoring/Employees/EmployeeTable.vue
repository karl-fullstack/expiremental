<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Employee Records</h1>
                <div class="card mt-5">
                    <b-table :items="employees" :fields="employee_fields">
                      <template v-slot:cell(full_name)="data">
                        {{ `${data.item.first_name} ${data.item.last_name}` }}
                      </template>
                      <template v-slot:cell(birth_date)="data">
                        {{ data.item.birth_date | moment("dddd, MMMM Do YYYY") }}
                      </template>
                    </b-table>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Swal from "sweetalert2";
    // import EmployeeData from "./EmployeeData";
    export default {
        components: {
        },
        data(){
            return{
                employees: [],    
                employee_fields: [ 
                  {key:"id", sortable: true},
                  {key:'full_name', sortable: true},
                  {key:'birth_date', sortable: true},
                  {key:'email', sortable: true},
                  {key:'phone_number', sortable: true},
                  {key:'landline_number', sortable: true},
                  {key:'address'},
                ],
            }
            
        },
        filters:{
        },
        methods:{
          fetchEmployees(){
              axios.get('/api/employees').then(({data}) => (this.employees = data));
            }
        },    
        created() {
            this.fetchEmployees();
        },
    }
</script>
