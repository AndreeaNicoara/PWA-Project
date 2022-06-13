<template>
    <div> 

         <v-card-title 
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                        Add Project

                        <v-card-actions class="float-position-right ">
                            <v-btn
                            
                            text
                            @click="closeAddProjectDialog"
                            class="margin-top-minus-10"
                            >
                            X
                            </v-btn>
                        </v-card-actions>

                    </v-card-title>
      
            <div v-if="validationError">

                <v-alert
                    v-model="validationError"
                    dismissible
                    type="error"
                    >
                    Please fill all required fields.
                </v-alert>
                
            </div>

            <form  method="POST" id="formAddProject" class="lcs-form">
    <div class="card-body">
        <section class="wizard-section">
            <div class="row no-gutters">
                
                <div class="col-lg-12 col-md-12">
                    <div class="form-wizard">
                        <form action="" id="formAddProjectData" method="post" role="form">
                            <div class="form-wizard-header">
                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="active"><span>1</span></li>
                                    <li><span>2</span></li>
                                    <li><span>3</span></li>
                                </ul>
                            </div>

                            
                            <fieldset class="wizard-fieldset show">
                                <h3>Project Setup</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectType">Project Type <span class="required">*</span></label>
                                            <select class="form-control wizard-required" id="inputProjectType" v-model="form.project_type" name="project_type">
                                                <option value=""></option>
                                                <option value="REST_API_MD">Rest API Template - Multimedia Designer</option>
                                                <option value="REST_API_WD">Rest API Template - Web Development</option>
                                                <option value="EMPTY_TEMPLATE">Empty Template</option>
                                            </select>
                                            <span class="text-danger input-error project_type-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectStatus">Project Status <span class="required">*</span></label>
                                            <select class="form-control" id="inputProjectStatus"  v-model="form.project_status" name="project_status">
                                                <option value="">Select Status</option>
                                                <option value="NEW">New</option>
                                                <option value="OPENED">Opened</option>
                                                <option value="INPROGRESS">In Progress</option>
                                                <option value="COMPLETED">Completed</option>
                                            </select>
                                            <span class="text-danger input-error status-error"></span>
                                        </div>
                                    </div>
                                </div>

                            
                                <h5>Project</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectName">Project Name <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectName" v-model="form.project_name" name="project_name">
                                            <span class="text-danger input-error project_name-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="inputProjectCode">Project Code <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectCode" v-model="form.project_code" name="project_code">
                                            <span class="text-danger input-error project_code-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputProjectDescription">Project Description </label>
                                            <textarea class="form-control" id="inputProjectDescription" v-model="form.project_description" name="project_description" maxlength="200"></textarea>
                                            <span class="text-danger input-error project_description-error"></span>
                                        </div>
                                    </div>
                                </div>
                              
                            
                                <h5>Time Shedule</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputStartDate">Start Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputStartDate" v-model="form.start_date" name="start_date" placeholder="">
                                            <span class="text-danger input-error start_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEndDate">End Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputEndDate" v-model="form.end_date" name="end_date" placeholder="">
                                            <span class="text-danger input-error end_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTotalHours">Total Hour(s) <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputTotalHours" v-model="form.total_hours" name="total_hours">
                                            <span class="text-danger input-error total_hours-error wizard-form-error"></span>
                                        </div>
                                    </div>
                                </div>


                                <h5>Stakeholders</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputStakeholders">Stakeholder/Partners </label>
                                            <input type="text" class="form-control" id="inputStakeholders" v-model="form.stakeholders" name="stakeholders" placeholder="">
                                            <span class="text-danger input-error stakeholders-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>


                                <h5>Members</h5>
                                <hr/>


                                <div class="row" >
                                    <div class="col-lg-4">
                                        <a style="color:#fb0" class="add-more-member">Add Project Member</a>
                                    </div>
                                </div>

                                <div class="row project_members" style="display: none;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectMember">Project Members </label>
                                            <select class="form-control" id="inputProjectMembers" v-model="form.project_members" name="project_members[]" placeholder="">
                                                <option value=""></option>
                                                <!-- <?php foreach ($project_managers as $key => $project_manager) { ?> -->
                                                    <!-- <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option> -->
                                                    <option v-for="(projectManager, index) in projectManagersList" :key="index" :value="projectManager.id">{{projectManager.first_name + ' ' + projectManager.last_name}}</option>
                                                <!-- <?php } ?> -->
                                            </select>
                                            <span class="text-danger input-error project_leader-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 control-btn">
                                    </div>
                                </div>

                                <div class="project_members_dynamic"></div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> 
                            <fieldset class="wizard-fieldset">
                                <h3>Project Tasks</h3>

                                <div class="row" >
                                    <div class="col-lg-4">
                                        <a class="add-more-task" >Add Task</a>
                                    </div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <div class="row project_tasks" style="display: none;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectTask">Project Task</label>
                                            <input type="text" class="form-control" id="inputProjectTasks" name="project_tasks[]" placeholder="">
                                                
                                            <span class="text-danger input-error project_tasks-error"></span>
                                        </div>


                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectTaskUser">Project Task Users </label>
                                            <select class="form-control" id="inputProjectTaskUser" name="project_task_users[]" placeholder="">
                                                <option value=""></option>
                                                <!-- <?php foreach ($project_managers as $key => $project_manager) { ?> -->
                                                    <!-- <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option> -->
                                                    <option v-for="(projectManager, index) in projectManagersList" :key="index" :value="projectManager.id">{{projectManager.first_name + ' ' + projectManager.last_name}}</option>
                                                    <!-- <option value="<?php echo $project_manager->user_id;?>">asa44</option> -->
                                                <!-- <?php } ?> -->
                                            </select>
                                            <span class="text-danger input-error project_task_users-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 control-btn">
                                    </div>
                                </div>

                                <div class="project_tasks_dynamic"></div>

                                <div class="row" >
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="inputApiTemplates" class="wizard-form-text-label">Rest API Templates Items(Multimedia Designers)</label><br/><br/>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="WEB_APP">
                                            <label for=""> Web App</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="STATIONARIES">
                                            <label for=""> Stationaries</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="Report">
                                            <label for=""> Report</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="SEO_CHECKLIST">
                                            <label for=""> SEO Checklist</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="BRING_EDUCATOR_AN_APPLE">
                                            <label for=""> Bring Educator an Apple</label><br> 
                                            <span class="text-danger input-error stakeholders-error"></span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </fieldset> 
                            <fieldset class="wizard-fieldset management">
                                <h3>Management</h3>
                                <div id="dynamic-project-member-view">
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputGitHubRepository">gitHUB Repository </label>
                                            <input type="text" class="form-control" id="inputGitHubRepository" name="github_repository" placeholder="">
                                            <span class="text-danger input-error github_repository-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTechnologyUsed">Technology Used </label>
                                            <input type="text" class="form-control" id="inputTechnologyUsed" name="technology_used" placeholder="">
                                            <span class="text-danger input-error technology_used-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <br/>
                                        <a class="addmore" style="cursor: pointer;" onclick="add_more_technology()">
                                           Add technology
                                        </a>
                                    </div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <h5>Project Technology</h5>
                                <hr/>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <table width="100%" class="table" id="projectTechnologyTable">
                                            <thead>
                                                <tr>
                                                    <th>Technologies</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <!-- <a href="javascript:;" class="form-wizard-submit float-right">Submit</a> -->
                                            <button type="submit" class="form-wizard-submit float-right" @click="submitForm" id="formAddProjectSubmit">Submit</button>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="message-box" style="text-align:center;">
                                            
                                        </div>
                                    </div>
                                </div>

                                
                                
                            </fieldset> 
                             
                        </form>
                           </div>
                </div>
            </div>
        </section>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    
                </div>
            </div>
        </div>
    </div>
</form>

   

          

      
        
    </div>

</template>


<script>
    
    import { mapGetters, mapActions } from "vuex";
    import store from '../../../store'

    export default {
        data() {
            return {
                form: {
                    project_type: null,
                    project_status: null,
                    project_name: null,
                    project_code: null,
                    project_description: null,
                    start_date: null,
                    end_date: null,
                    total_hours: null,
                    stakeholders: null,
                    project_members: [],
                },

                validationError: false
            }
        },

        components: {
           
        },

        mounted () {

            this.getProjectMembers();

            setTimeout(() => {

                jQuery(document).ready(function() {

                    jQuery('.form-wizard-next-btn').click(function() {
                       
                        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                        var next = jQuery(this);
                        var nextWizardStep = true;
                        parentFieldset.find('.wizard-required').each(function(){
                            var thisValue = jQuery(this).val();

                            if( thisValue == "") {
                                jQuery(this).siblings(".wizard-form-error").slideDown();
                                nextWizardStep = false;
                            }
                            else {
                                jQuery(this).siblings(".wizard-form-error").slideUp();
                            }
                        });
                        if( nextWizardStep) {
                            next.parents('.wizard-fieldset').removeClass("show","400");
                            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
                            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
                            jQuery(document).find('.wizard-fieldset').each(function(){
                                if(jQuery(this).hasClass('management')){//Check if management class exists
                                    $("#dynamic-project-member-view").html("");//Clear area by ID
                                        var member_ids=[]; 
                                        $('select[name="project_members[]"] option:selected').each(function() {//Loop through all selected project members
                                        member_ids.push($(this).val());//Put selected members to array
                                        });
                                        
                                        var formData = {
                                            member_ids:member_ids
                                        }

                                        axios
                                        .post("/api/front/get-project-member-list", formData)
                                        .then(response => {
                                    
                                                if(response.data){
                                                    $('#dynamic-project-member-view').html(response.data);
                                                    
                                                }else{
                                                    $('.message-box').html('<div class="alert alert-danger">Something went wrong</div>');
                                                }
                                        })
                                        .catch(error => {
                                    
                                            alert("Something went wrong");
                                        });

                                        // $.ajaxSetup({
                                        //     headers: {
                                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        //     }
                                        // });


                                        // $.ajax({
                                        //     url     : "{{URL::to('get-project-member-list')}}",
                                        //     type    : 'POST',
                                        //     data    : {member_ids:member_ids},
                                        //     success : function ( data ){
                                        //         if(data){
                                        //             $('#dynamic-project-member-view').html(data);
                                                    
                                        //         }else{
                                        //             $('.message-box').html('<div class="alert alert-danger">Something went wrong</div>');
                                        //         }
                                        //     },
                                        //     error: function( data ){
                                        //         alert("Something went wrong");
                                        //     }
                                        // });

                                }
                                if(jQuery(this).hasClass('show')){

                                    var formAtrr = jQuery(this).attr('data-tab-content');
                                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                                        if(jQuery(this).attr('data-attr') == formAtrr){
                                            jQuery(this).addClass('active');
                                            var innerWidth = jQuery(this).innerWidth();
                                            var position = jQuery(this).position();
                                            jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                                        }else{
                                            jQuery(this).removeClass('active');
                                        }
                                    });
                                }
                            });
                        }

                });


                
                //Add project member
                $('.add-more-member').click(function() {

                    var cloneRow = $('.project_members').clone();
                    cloneRow.removeClass('project_members');
                    cloneRow.addClass('remove');
                    cloneRow.show();
                    cloneRow.find('.control-btn').append('<a class="remove-field btn-remove-member" id="btnsave" onclick="remove_member(this)">Remove member</a>');
                    cloneRow.appendTo('.project_members_dynamic');

                });

               window.remove_member= remove_member;

                //Remove project member
                function remove_member(element){
                    $(element).closest('.remove').remove();
                }

                //Add project task
                $('.add-more-task').click(function() {
                    var cloneRow = $('.project_tasks').clone();
                    cloneRow.removeClass('project_tasks');
                    cloneRow.addClass('remove');
                    cloneRow.show();
                    cloneRow.find('.control-btn').append('<a href="#" class="remove-field btn-remove-task" onclick="remove_task(this)">Remove Task</a>');
                    cloneRow.appendTo('.project_tasks_dynamic');

                });

                window.remove_task= remove_task;
                                
                //Remove project task
                function remove_task(element){
                    $(element).closest('.remove').remove();
                }

                window.add_more_role= add_more_role;

                //Add more roles
                function add_more_role(){
                    $('.input-error').text("");
                    var selected_member_id = $("#inputProjectMemberList").val();
                    var selected_member_text = $("#inputProjectMemberList option:selected" ).text();

                    var selected_role = $("#inputProjectMemberRole").val();
                    var selected_estimate_hour = $("#inputProjectEstimateHour").val();

                    var rowCount = $('#projectRolesTable tbody tr').length;
                    var newRowCount = rowCount+1;

                        $('#projectRolesTable tbody').append('<tr data-row="'+newRowCount+'"><td>'+selected_member_text+'<input type="hidden" name="selected_member_ids[]" value="'+selected_member_id+'"/></td><td>'+selected_role+'<input type="hidden" name="selected_roles[]" value="'+selected_role+'"/></td><td>'+selected_estimate_hour+'<input type="hidden" name="selected_estimate_hours[]" value="'+selected_estimate_hour+'"/></td><td><a onclick="remove_role(this)">Remove Role</a></td></tr>');
                
                }

                window.remove_role= remove_role;

                
                //Remove role
                function remove_role(element){
                    $(element).closest('tr').remove();
                }

                window.add_more_technology= add_more_technology;

                //Add more technologies
                function add_more_technology(){
                    $('.input-error').text("");
                    var technologyused = $("#inputTechnologyUsed").val();

                    var rowCount = $('#projectTechnologyTable tbody tr').length;
                    var newRowCount = rowCount+1;

                    if(technologyused!=""){

                        $('#projectTechnologyTable tbody').append('<tr data-row="'+newRowCount+'"><td>'+technologyused+'<input type="hidden" name="project_technologies[]" value="'+technologyused+'"/></td><td><a onclick="remove_technology(this)">Remove Technology</a></td></tr>');
                    }else{
                        if(technologyused==""){
                            $(".technology_used-error").html("Technology is required");
                        }
                    }
                }

                window.remove_technology= remove_technology;

                //Remove technology
                function remove_technology(element){
                    $(element).closest('tr').remove();
                }

                //Click on previous button
                jQuery('.form-wizard-previous-btn').click(function() {
                    var counter = parseInt(jQuery(".wizard-counter").text());;
                    var prev =jQuery(this);
                    var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                    prev.parents('.wizard-fieldset').removeClass("show","400");
                    prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
                    currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
                    jQuery(document).find('.wizard-fieldset').each(function(){
                        if(jQuery(this).hasClass('show')){
                            var formAtrr = jQuery(this).attr('data-tab-content');
                            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                                if(jQuery(this).attr('data-attr') == formAtrr){
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                                }else{
                                    jQuery(this).removeClass('active');
                                }
                            });
                        }
                    });
                });




              });


            // window.addEventListener('DOMContentLoaded', function() {
                 
            // });
                
            }, 1000);
           
        },
        

        computed: {
            ...mapGetters({
                projectManagersList: "projectManagersList",
            })
        },

        methods: {

            ...mapActions({
                addProject: "addProject",
                getProjectMembers: "getProjectMembers",
            }),

            closeAddProjectDialog(){
            
                // $("#formAddProjectData")[0].reset();

                setTimeout(() => {
                    this.$root.$emit("createProjectModal", false);
                }, 10);
               

            },

            
            submitForm(e){

                e.preventDefault();


                var form = $('#formAddProjectData'); 
                // let formData = new FormData(form);

                let formData = form.serialize();

                console.log('Submitted');
               

                // if(this.form.first_name == null || this.form.last_name == null || this.form.user_type == null || this.form.username == null || this.form.password == null || this.form.status == null){
                //     this.validationError = true;
                // }else{

                    // this.validationError = false;
            
                    this.addProject(formData).then(() => {

                        // form.reset();

                        setTimeout(() => {
                            this.$root.$emit("createProjectModal", false);
                        }, 10);
                        

                    }).catch(error => {
                    
                        
                        console.log('Something went wrong');
                        
                        
                    });
                    

                //  }
            }

          
            
        }

    }
</script>

<style scoped>
    
.form-wizard {
  color: #ffffff;
  padding: 30px;
}
.form-wizard h3{
  color: #27292c;
  text-transform: uppercase;
  border-bottom: 1px solid #27292c;
  padding-bottom: 3px;
}
.form-wizard h5{
  color: #27292c;
}
.form-wizard .wizard-form-radio {
  display: inline-block;
  margin-left: 5px;
  position: relative;
}
.form-wizard .wizard-form-radio input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  background-color: #dddddd;
  height: 25px;
  width: 25px;
  display: inline-block;
  vertical-align: middle;
  border-radius: 50%;
  position: relative;
  cursor: pointer;
}
.form-wizard .wizard-form-radio input[type="radio"]:focus {
  outline: 0;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked {
  background-color: #fb1647;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked::before {
  content: "";
  position: absolute;
  width: 10px;
  height: 10px;
  display: inline-block;
  background-color: #ffffff;
  border-radius: 50%;
  left: 1px;
  right: 0;
  margin: 0 auto;
  top: 8px;
}
.form-wizard .wizard-form-radio input[type="radio"]:checked::after {
  content: "";
  display: inline-block;
  webkit-animation: click-radio-wave 0.65s;
  -moz-animation: click-radio-wave 0.65s;
  animation: click-radio-wave 0.65s;
  background: #000000;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
  border-radius: 50%;
}
.form-wizard .wizard-form-radio input[type="radio"] ~ label {
  padding-left: 10px;
  cursor: pointer;
}
.form-wizard .form-wizard-header {
  text-align: center;
}
.form-wizard .form-wizard-next-btn, .form-wizard .form-wizard-previous-btn, .form-wizard .form-wizard-submit {
  background-color: #fb0;
  color: #ffffff;
  display: inline-block;
  min-width: 100px;
  min-width: 120px;
  padding: 10px;
  text-align: center;
}
.form-wizard .form-wizard-next-btn:hover, .form-wizard .form-wizard-next-btn:focus, .form-wizard .form-wizard-previous-btn:hover, .form-wizard .form-wizard-previous-btn:focus, .form-wizard .form-wizard-submit:hover, .form-wizard .form-wizard-submit:focus {
  color: #ffffff;
  opacity: 0.6;
  text-decoration: none;
}
.form-wizard .wizard-fieldset {
  display: none;
}
.form-wizard .wizard-fieldset.show {
  display: block;
}
.form-wizard .wizard-form-error {
  display: none;
  background-color: #d70b0b;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.form-wizard .form-wizard-previous-btn {
  background-color: #fb1647;
}
.form-wizard .form-control {
  font-weight: 300;
  height: auto !important;
  padding: 7px;
  color: #888888;
  background-color: #f1f1f1;
  border: none;
}
.form-wizard .form-control:focus {
  box-shadow: none;
}
.form-wizard .form-group {
  position: relative;
  margin: 5px 0;
}
.form-wizard .wizard-form-text-label {
  position: absolute;
  left: 10px;
  top: 6px;
  transition: 0.2s linear all;
}
.form-wizard .focus-input .wizard-form-text-label {
  color: #fb0;
  top: -18px;
  transition: 0.2s linear all;
  font-size: 12px;
}
.form-wizard .form-wizard-steps {
  margin: 30px 0;
}
.form-wizard .form-wizard-steps li {
  width: 25%;
  float: left;
  position: relative;
}
.form-wizard .form-wizard-steps li::after {
  background-color: #27292c;
  content: "";
  height: 5px;
  left: 0;
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  border-bottom: 1px solid #dddddd;
  border-top: 1px solid #dddddd;
}
.form-wizard .form-wizard-steps li span {
  background-color: #27292c;
  border-radius: 50%;
  display: inline-block;
  height: 40px;
  line-height: 40px;
  position: relative;
  text-align: center;
  width: 40px;
  z-index: 1;
}
.form-wizard .form-wizard-steps li:last-child::after {
  width: 50%;
}
.form-wizard .form-wizard-steps li.active span, .form-wizard .form-wizard-steps li.activated span {
  background-color: #fb0;
  color: #ffffff;
}
.form-wizard .form-wizard-steps li.active::after, .form-wizard .form-wizard-steps li.activated::after {
  background-color: #fb0;
  left: 50%;
  width: 50%;
  border-color: #fb0;
}
.form-wizard .form-wizard-steps li.activated::after {
  width: 100%;
  border-color: #fb0;
}
.form-wizard .form-wizard-steps li:last-child::after {
  left: 0;
}
.form-wizard .wizard-password-eye {
  position: absolute;
  right: 32px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}

</style>

                