<template>
    <div class="container-fluid">
        

        <div class="row justify-content-center">
          
            <div class="col-md-8">
                <h1>Employee Records</h1>

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

                <div class="card">
                    <b-table 
                    :items="employees" 
                    :fields="employee_fields" 
                    sort-icon-left      
                    responsive="sm"
                    :filter="table_filter"
                    :filter-debounce="0"
                    sticky-header>
                  
                      <template v-slot:cell(full_name)="data">
                        {{ `${data.item.first_name} ${data.item.last_name}` }}
                      </template>
                      <template v-slot:cell(action)="data">
                        <b-button size="sm" @click="data.toggleDetails" class="mr-2">
                          {{ data.detailsShowing ? 'Hide' : 'Show'}} Details
                        </b-button>
                      </template>
                      <template v-slot:row-details="data">
                        <b-card>
                          <h5>Personal Info</h5>
                          <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Birthday:</b></b-col>
                            <b-col>{{ data.item.birth_date | moment("dddd, MMMM Do YYYY") }}</b-col>
                          </b-row>

                          <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Address:</b></b-col>
                            <b-col>{{ `${data.item.address}, ${data.item.state}, ${data.item.city}, ${data.item.region} , ${data.item.country}` }}</b-col>
                          </b-row>

                          <h5>Job Info</h5>
                          <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Job Title:</b></b-col>
                            <b-col>{{ data.item.job_title }}</b-col>
                          </b-row>

                          <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Salary:</b></b-col>
                            <b-col>{{ data.item.salary | currency }}</b-col>
                          </b-row>

                          <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Employment Date:</b></b-col>
                            <b-col>{{ data.item.employment_date | moment("dddd, MMMM Do YYYY")}}</b-col>
                          </b-row>
                        </b-card>
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
                  {key:'email', sortable: true},
                  {key:'phone_number'},
                  {key:'landline_number'},
                  {key:'action'},
                ],
                table_filter: '',
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
