<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>This is a test case</h1>
                <div class="card mt-5">
                  <b-button variant="info" @click="createTestCaseModal(), editmode=false">Create Test Case</b-button>   
                    <b-table striped hover :items="test_cases" :fields="fields">
                        <template v-slot:cell(action)="data">
                            <b-button variant="success" v-b-modal.view_test_case_modal @click="loadSpecificTestCases(data.item), editmode=true"><i class="fas fa-eye"></i></b-button>
                            <b-button variant="primary" v-b-modal.test_case_modal @click="loadSpecificTestCases(data.item), editmode=true"><i class="fas fa-edit"></i></b-button>
                            <b-button variant="danger" @click="deleteTestCase(data.item.id)">Delete</b-button>
                        </template>
                    </b-table>

                </div>
            </div>
        </div>

        <!-- start: Test Case Modal -->
        <b-modal id="test_case_modal" size="xl" hide-footer>
          <template v-slot:modal-title>
            <div v-if="editmode">Edit Test Case</div>
            <div v-else>Create Test Case</div>
          </template>
          <b-form>
            <h5>Basic Information</h5>
            <b-form-group id="input-group-1" label="Test Case ID:" label-for="test_case_id" label-cols-lg="3" description="Please use project name as prefix for id (e.g. SampleProject_001)">
              <b-form-input id="test_case_id" v-model="form.test_case_id" type="text" required></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-1" label="Test Case Description:" label-for="test_case_description" label-cols-lg="3" description="Describe what will be tested">
              <b-form-input id="test_case_description" v-model="form.test_case_description" type="text" required></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-1" label="Created by:" label-for="created_by_id" label-cols-lg="3">
              <b-form-input id="created_by_id" v-model="form.created_by_id" type="text" required></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-1" label="Reviewed by:" label-for="reviewed_by_id" label-cols-lg="3">
              <b-form-input id="reviewed_by_id" v-model="form.reviewed_by_id" type="text" required></b-form-input>
            </b-form-group>
            
            <b-form-group id="input-group-1" label="Version:" label-for="test_case_version" label-cols-lg="3" description="This describes the revision of the test">
              <b-form-input id="test_case_version" v-model="form.test_case_version" type="text" required></b-form-input>
            </b-form-group>

            <hr>
            <h5>QA Log</h5>
            <b-form-group id="input-group-1" label="QA Tester's Log:" label-for="qa_tester_log" label-cols-lg="3" description="QA's Log / General comment">
              <b-form-input id="qa_tester_log" v-model="form.qa_tester_log" type="text" required></b-form-input>
            </b-form-group>

            <hr>
            <h5>Tester's Information</h5>
            <b-form-group id="input-group-1" label="Tester's Name:" label-for="tester_id" label-cols-lg="3">
              <b-form-input id="tester_id" v-model="form.tester_id" type="text" required></b-form-input>
            </b-form-group>
            
            <b-form-group id="input-group-1" label="Date Tested:" label-for="tested_at" label-cols-lg="3">
              <b-form-input id="tested_at" v-model="form.tested_at" type="date" required></b-form-input>
            </b-form-group>
            
            <b-form-group id="input-group-1" label="Test Result:" label-for="test_case_result" label-cols-lg="3" description="Choose between: Past / Fail">
              <b-form-input id="test_case_result" v-model="form.test_case_result" type="text" required></b-form-input>
            </b-form-group>

            <hr>
            <h5>Test Requirements</h5>
            <b-form-group id="input-group-1" label="Prerequisites:" label-for="prerequisites" label-cols-lg="3" description="What are the things that you need for this test?">
              <div v-for="(prerequisites, k) in form.prerequisites" :key="k">
                <div class="row">
                  <div class="col-sm-1"><strong>#{{prerequisites.number}}</strong></div>
                  <div class="col-sm-9"><b-form-input id="prerequisites" v-model="prerequisites.description" type="text" required placeholder="Description"></b-form-input> </div>
                  <div class="col-sm-1">
                    <b-button @click="addPrerequisites" v-show="k < 1" variant="success"><i class="fas fa-plus-circle"></i></b-button>
                    <b-button @click="removePrerequisites(k)" v-show="k || ( !k && prerequisites.length > 1)" variant="danger"><i class="fas fa-minus-circle"></i></b-button>
                  </div>
                </div>
              </div>
            </b-form-group>

            <b-form-group id="input-group-1" label="Test Data:" label-for="test_data" label-cols-lg="3" description="Data that you are going to use for this test.">
              <div v-for="(test_data, k) in form.test_data" :key="k">
                <div class="row">
                  <div class="col-sm-1"><strong>#{{test_data.number}}</strong></div>
                  <div class="col-sm-9"><b-form-input id="test_data" v-model="test_data.description" type="text" required placeholder="Description"></b-form-input> </div>
                  <div class="col-sm-1">
                    <b-button @click="addTestData" v-show="k < 1" variant="success"><i class="fas fa-plus-circle"></i></b-button>
                    <b-button @click="removeTestData(k)" v-show="k || ( !k && test_data.length > 1)" variant="danger"><i class="fas fa-minus-circle"></i></b-button>
                  </div>
                </div>
              </div>
            </b-form-group>

            <b-form-group id="input-group-1" label="Test Scenario:" label-for="test_scenario" label-cols-lg="3" description="How the test will be done.">
              <b-form-input id="test_scenario" v-model="form.test_scenario" type="text" required></b-form-input>
            </b-form-group>

            <hr>
            <h5>Test Case Steps</h5>
            <b-form-group id="input-group-1" label-for="test_steps" description="Describe the process to achieve the desired test scenario.">
              <table class="table table-sm">
                <tr>
                  <th>Steps #</th>
                  <th>Details</th>
                  <th>Expected Results</th>
                  <th>Actual Results</th>
                  <th>Remarks</th>
                  <th>+ / -</th>
                </tr>
                <tr v-for="(test_steps, k) in form.test_steps" :key="k">
                  <td>
                    <strong>#{{test_steps.steps}}</strong>
                  </td>
                  <td>
                    <b-form-textarea id="test_steps.details" v-model="test_steps.details" placeholder="Details" rows="3" max-rows="6"></b-form-textarea>
                  </td>
                  <td>
                    <b-form-textarea id="test_steps.expected_results" v-model="test_steps.expected_results" placeholder="Expected Result" rows="3" max-rows="6"></b-form-textarea>
                  </td>
                  <td>
                    <b-form-textarea id="test_steps.actual_results" v-model="test_steps.actual_results" placeholder="Actual Result" rows="3" max-rows="6"></b-form-textarea>
                  </td>
                  <td>
                    <b-form-input id="test_steps.remarks" v-model="test_steps.remarks" type="text" placeholder="Remarks"></b-form-input>
                  </td>
                  <td>  
                    <b-button @click="addTestCaseSteps" v-show="k < 1" variant="success"><i class="fas fa-plus-circle"></i></b-button>
                    <b-button @click="removeTestCaseSteps(k)" v-show="k || ( !k && test_steps.length > 1)" variant="danger"><i class="fas fa-minus-circle"></i></b-button>
                  </td>
                  <!-- <div class="row">
                    <div class="col-sm-1"><strong>#{{test_steps.steps}}</strong></div>
                    <div class="col-sm-3">
                      <b-form-textarea id="test_steps.details" v-model="test_steps.details" placeholder="Details" rows="3" max-rows="6"></b-form-textarea>
                    </div>
                    <div class="col-sm-3">
                      <b-form-textarea id="test_steps.expected_results" v-model="test_steps.expected_results" placeholder="Expected Result" rows="3" max-rows="6"></b-form-textarea>
                    </div>
                    <div class="col-sm-2">
                      <b-form-textarea id="test_steps.actual_results" v-model="test_steps.actual_results" placeholder="Actual Result" rows="3" max-rows="6"></b-form-textarea>
                    </div>
                    <div class="col-sm-1"><b-form-input id="test_steps.remarks" v-model="test_steps.remarks" type="text" required placeholder="Remarks"></b-form-input> </div>
                    <div class="col-sm-1">
                      <b-button @click="addTestCaseSteps" v-show="k < 1" variant="success"><i class="fas fa-plus-circle"></i></b-button>
                      <b-button @click="removeTestCaseSteps(k)" v-show="k || ( !k && test_steps.length > 1)" variant="danger"><i class="fas fa-minus-circle"></i></b-button>
                    </div>
                  </div> -->
                </tr>
              </table>
              
            </b-form-group>

            <hr>
            <h5>QA's Remark</h5>
            <b-form-group id="input-group-1" label="QA Comments:" label-for="qa_comments" label-cols-lg="3" description="Comments regarding the Test Case (E.g. Improvements, Errors, Etc...)">
              <b-form-textarea id="qa_comments" v-model="form.qa_comments" placeholder="Actual Result" rows="3" max-rows="6"></b-form-textarea>
            </b-form-group>

            <div class="text-center">
              <b-button v-show="editmode" variant="primary" @click="updateTestCase" >Update</b-button>
              <b-button v-show="!editmode" variant="primary"  @click="createTestCase" >Submit</b-button>
            </div>

          </b-form>
        </b-modal>
        <!-- end: Test Case Modal -->

        <!-- start: View Test Case Modal -->
        <b-modal id="view_test_case_modal" size="xl" hide-footer>

          <template v-slot:modal-title>
            Test Case ID: {{form.test_case_id}} (v.{{form.test_case_version}})
          </template>

          <p>Description: <i>{{form.test_case_description}}</i></p>

          <hr/>
          <h5>QA's Log</h5>    
          <p>
            {{form.qa_tester_log}}
          </p>
          <hr/>

          <h5>Tester's Information</h5>
          <table class="table table-sm">
            <tr>
              <th>Tested by:</th>
              <td>{{form.tester_id}}</td>
              <th>Tested at:</th>
              <td>{{form.tested_at}}:</td>
              <th>Test result:</th>
              <td>{{form.test_case_result}}</td>
            </tr>  
          </table>    
          <hr/>

          <h5>Test Requirements</h5>    
           <table class="table table-sm">
            <tr>
              <th>Prerequisites: </th>
              <td>
                {{ form.prerequisites }}

                <!-- <ol>
                  <td v-for="prerequisites in form.prerequisites" :key="prerequisites.number">
                    {{ prerequisites }}
                  </td>
                </ol> -->

              </td>
              <th>Test Data: </th>
              <td>{{ form.test_data }}</td>
            </tr>
          </table>
          <p><b>Test Scenario:</b> <i> {{form.test_scenario}}</i></p>
          <hr/>

          <h5>Test Case Steps</h5> 
          <p> {{ form.prerequisites }}</p>
          <hr/>

          <h5>QA's Remarks</h5> 
          <p> {{ form.qa_comments }}</p>

          <table class="table table-sm">
            <tr>
              <th>Created by: </th>
              <td>{{ form.created_by_id }}</td>
              <th>Reviewed by: </th>
              <td>{{ form.reviewed_by_id }}</td>
            </tr>
          </table>


        </b-modal>
        <!-- end: View Test Case Modal -->
    </div>
</template>

<script>
    import Swal from "sweetalert2";
    import Form from "vform";
    export default {
        data(){
            return{
                //checks if the form is in edit mode.
                editmode: true,
                
                // This is the array that will hold the list of task
                test_cases: [],

                // This is the fields for the table
                fields: [ 
                    {key:'project_id', sortable: true},
                    {key:'test_case_id', sortable: true},
                    {key:'test_case_description', sortable: true},
                    {key:'tester_id', sortable: true, label: 'Tester'},
                    {key:'action'},
                ],

                // Catches the amount of prerequisites
                prerequisites_number: 1,

                // Catches the amount of test data
                test_data_number: 1,

                // Catches the amount of test steps
                test_steps_number: 1,

                // Variable that will hold the form model
                form: new Form ({
                    project_id: '',
                    test_case_id: '',
                    test_case_version: '',
                    test_case_description: '',
                    created_by_id: '',
                    reviewed_by_id: '',
                    tester_id: '',
                    qa_tester_log: '',
                    tested_at: '',
                    test_case_result: '',
                    prerequisites: [{
                      number: 1,
                      description: '',
                    }],
                    test_data: [{
                      number: 1,
                      description: '',
                    }],
                    test_scenario: '',
                    test_steps: [{
                      steps: 1,
                      details: '',
                      expected_results: '',
                      actual_results: '',
                      remark: '',
                    }],
                    qa_comments: '',
                }),

                // Options for priority rate select form
                options: [
                    { value: null, text: 'Please select an option', disabled:true },
                    { value: '0', text: 'Not Important' },
                    { value: '1', text: 'Important' },
                    { value: '2', text: 'ASAP'}
                ]
            }
            
        },
        methods:{
            parseData(data){
             return data;
              // return JSON.parse(data);
            },

            // This loads all the test case
            loadTestCases(){ 
                axios.get('/api/test_case').then(({data}) => (this.test_cases = data)); //fetch data and give the ddata to this.test_cases
            },

             // This loads a specific test case
            loadSpecificTestCases(test_cases){
                this.form.fill(test_cases);
            },
            
            //This function lets you create test cases
            createTestCase(){ 
                this.form.post('/api/test_case')
                    .then(
                      Fire.$emit('AfterCreate'),
                      this.$bvModal.hide('test_case_modal'),
                      Swal.fire({
                        title: 'Created!',
                        text: 'A Test Case has been created!',
                        type: 'success',
                        confirmButtonText: 'Close'
                      }),
                      this.resetCounters(),
                    ).catch();
            },

            //This function lets you update test cases
            updateTestCase(){ 
                this.form.patch('/api/test_case/'+this.form.id)
                    .then(
                      Fire.$emit('AfterCreate'),
                      this.$bvModal.hide('test_case_modal'),
                      Swal.fire({
                        title: 'Updated!',
                        text: 'Your Data has been updated!',
                        type: 'success',
                        confirmButtonText: 'Close'
                      }),
                      this.resetCounters(),
                    ).catch();
            },

            //This function lets you delete tes tcases
            deleteTestCase(id){
                this.form.delete('/api/test_case/'+id)
                    .then(Fire.$emit('AfterCreate'))
                    .catch();
            },
            createTestCaseModal(){
              this.$bvModal.show('test_case_modal'),
              this.form.reset()
            },

            /*
            * Starting this point is where all the dynamic form functions are held. 
            */

           // This add a form for prerequisites
            addPrerequisites(){
              this.form.prerequisites.push({
                number: ++this.prerequisites_number,
                description:''
              })
            },

            // This removes a form for prerequisites
            removePrerequisites(step_id){
              this.form.prerequisites.splice(step_id, 1),
              --this.prerequisites_number
            },

            // This add a form for test_data
            addTestData(){
              this.form.test_data.push({
                number: ++this.test_data_number,
                description:''
              })
            },

            // This removes a form for test_data
            removeTestData(id){
              this.form.test_data.splice(id, 1),
              --this.test_data_number
            },

            // This add a form for test_steps
            addTestCaseSteps(){
              this.form.test_steps.push({
                steps:  ++this.test_steps_number,
                details: '',
                expected_results: '',
                actual_results: '',
                remark: '',
              })
            },

            // This removes a form for test_steps
            removeTestCaseSteps(id){
              this.form.test_steps.splice(id, 1),
              --this.test_steps_number
            },

            //Resets the counters
            resetCounters(){
              this.test_steps_number = 1;
              this.test_data_number = 1;
              this.prerequisites_number = 1;
            }
        },

        created() {
            // This automatically runs at the load of the component
            this.loadTestCases();
            Fire.$on('AfterCreate',() =>{
                this.loadTestCases();
            });
        },
    }
</script>
