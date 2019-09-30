<template>
  <!-- start: Task Modal -->
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
  <!-- end: Task Modal -->
</template>

