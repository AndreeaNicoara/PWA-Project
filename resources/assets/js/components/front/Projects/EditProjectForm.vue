<template>
    <div> 

        <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    Edit Project

                        <v-card-actions class="float-position-right ">
                            <v-btn
                            
                            text
                            @click="closeEditDialog"
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
                    <div class="form-wizard-edit">
                        <form action="" id="formEditProjectData" method="post" role="form">
                            <div class="form-wizard-edit-header">
                                <ul class="list-unstyled form-wizard-edit-steps clearfix">
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
                                             <input type="hidden" name="project_id" id="inputProjectId" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.project_id : null">
                                            <select class="form-control wizard-required" id="inputProjectType" name="project_type">
                                                <option value=""></option>
                                                <option value="REST_API_MD" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_type=='REST_API_MD'">Rest API Template - Multimedia Designer</option>
                                                <option value="REST_API_WD" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_type=='REST_API_WD'">Rest API Template - Web Development</option>
                                                <option value="EMPTY_TEMPLATE" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_type=='EMPTY_TEMPLATE'">Empty Template</option>
                                            </select>
                                            <span class="text-danger input-error project_type-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectStatus">Project Status <span class="required">*</span></label>
                                            <select class="form-control" id="inputProjectStatus" name="project_status">
                                                <option value="">Select Status</option>
                                                <option value="NEW" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_status=='NEW'">New</option>
                                                <option value="OPENED" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_status=='OPENED'">Opened</option>
                                                <option value="INPROGRESS" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_status=='INPROGRESS'">In Progress</option>
                                                <option value="COMPLETED" :selected="singleProject && singleProject != null && singleProject.project != null &&  singleProject.project.project_status=='COMPLETED'">Completed</option>
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
                                            <input type="text" class="form-control wizard-required" id="inputProjectName" name="project_name" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.project_name : ''">
                                            <span class="text-danger input-error project_name-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="inputProjectCode">Project Code <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectCode" name="project_code" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.project_code : ''">
                                            <span class="text-danger input-error project_code-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputProjectDescription">Project Description </label>
                                            <textarea class="form-control" id="inputProjectDescription" name="project_description" maxlength="200">{{singleProject && singleProject != null && singleProject.project != null ? singleProject.project.project_description : ''}}</textarea>
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
                                            <input type="date" class="form-control wizard-required" id="inputStartDate"  name="start_date" placeholder="" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.start_date : ''">
                                            <span class="text-danger input-error start_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEndDate">End Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputEndDate"  name="end_date" placeholder="" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.end_date : ''">
                                            <span class="text-danger input-error end_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTotalHours">Total Hour(s) <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputTotalHours"  name="total_hours" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.total_hours : ''">
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
                                            <input type="text" class="form-control" id="inputStakeholders"  name="stakeholders" placeholder="" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.stakeholder : ''">
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

                                <div class="row project_members_edit" style="display: none;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectMember">Project Members </label>
                                            <select class="form-control" id="inputProjectMembers" name="project_members[]" placeholder="">
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

                                <div class="project_members_dynamic">
                                    <div v-if="singleProject && singleProject != null && singleProject.project_members != null">
                                        <div class="row remove" style=""  v-for="(project_member, index) in singleProject.project_members" :key="index">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="inputProjectMember">Project Members </label>
                                                    <select class="form-control" id="inputProjectMembers" name="project_members[]" placeholder="">
                                                        <option value=""></option>
                                                          <option v-for="(projectManager, index) in projectManagersList" :key="index" :selected="projectManager.id==project_member.member_id" :value="projectManager.id">{{projectManager.first_name + ' ' + projectManager.last_name}}</option>
                                                        </select>
                                                    <span class="text-danger input-error project_leader-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 control-btn">
                                            <a class="remove-field btn-remove-member" onclick="remove_member(this)">Remove member</a></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-edit-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-edit-next-btn float-right">Next</a>
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

                                <div class="row project_tasks_edit" style="display: none;">
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
                                                <option v-for="(projectManager, index) in projectManagersList" :key="index" :value="projectManager.id">{{projectManager.first_name + ' ' + projectManager.last_name}}</option>
                                            </select>
                                            <span class="text-danger input-error project_task_users-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 control-btn">
                                    </div>
                                </div>

                                <div class="project_tasks_dynamic">
                                    <div v-if="singleProject && singleProject != null && singleProject.project_tasks != null">
                                       <div class="row remove" v-for="(project_task, index) in singleProject.project_tasks" :key="index">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="inputProjectTask">Project Task</label>
                                                <input type="text" class="form-control" id="inputProjectTasks" name="project_tasks[]" placeholder="" :value="project_task.project_task">
                                                    
                                                <span class="text-danger input-error project_tasks-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="inputProjectTaskUser">Project Task Users </label>
                                                <select class="form-control" id="inputProjectTaskUser" name="project_task_users[]" placeholder="">
                                                    <option value=""></option>
                                                    <option v-for="(projectManager, index) in projectManagersList" :key="index" :selected="projectManager.id==project_task.user_id" :value="projectManager.id">{{projectManager.first_name + ' ' + projectManager.last_name}}</option>
                                                </select>
                                                <span class="text-danger input-error project_task_users-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 control-btn">
                                        <a href="#" class="remove-field btn-remove-task" onclick="remove_task(this)">Remove Task</a></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="row" >
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="inputApiTemplates" class="wizard-form-text-label">Rest API Templates Items(Multimedia Designers)</label><br/><br/>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="WEB_APP" :checked="singleProject && singleProject != null && singleProject.api_template_items_array != null && singleProject.api_template_items_array.length > 0 && singleProject.api_template_items_array.includes('WEB_APP')">
                                            <label for=""> Web App</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="STATIONARIES" :checked="singleProject && singleProject != null && singleProject.api_template_items_array != null && singleProject.api_template_items_array.length > 0 && singleProject.api_template_items_array.includes('STATIONARIES')">
                                            <label for=""> Stationaries</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="Report" :checked="singleProject && singleProject != null && singleProject.api_template_items_array != null && singleProject.api_template_items_array.length > 0 && singleProject.api_template_items_array.includes('Report')">
                                            <label for=""> Report</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="SEO_CHECKLIST" :checked="singleProject && singleProject != null && singleProject.api_template_items_array != null && singleProject.api_template_items_array.length > 0 && singleProject.api_template_items_array.includes('SEO_CHECKLIST')">
                                            <label for=""> SEO Checklist</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="BRING_EDUCATOR_AN_APPLE" :checked="singleProject && singleProject != null && singleProject.api_template_items_array != null && singleProject.api_template_items_array.length > 0 && singleProject.api_template_items_array.includes('BRING_EDUCATOR_AN_APPLE')">
                                            <label for=""> Bring Educator an Apple</label><br> 
                                            <span class="text-danger input-error stakeholders-error"></span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-edit-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-edit-next-btn float-right">Next</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </fieldset> 
                            <fieldset class="wizard-fieldset management">
                                <h3>Management</h3>
                                <div id="dynamic-project-member-view-edit">
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputGitHubRepository">gitHUB Repository </label>
                                            <input type="text" class="form-control" id="inputGitHubRepository" name="github_repository" placeholder="" :value="singleProject && singleProject != null && singleProject.project != null ? singleProject.project.git_repository : ''">
                                            <span class="text-danger input-error github_repository-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTechnologyUsedEdit">Technology Used </label>
                                            <input type="text" class="form-control" id="inputTechnologyUsedEdit" name="technology_used" placeholder="">
                                            <span class="text-danger input-error technology_used-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <br/>
                                        <a class="addmore" style="cursor: pointer;" onclick="add_more_technology_edit()">
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

                                            <tbody v-if="singleProject && singleProject != null && singleProject.project_technologies != null && singleProject.project_technologies.length > 0">


                                                    <tr v-for="(technology, index) in singleProject.project_technologies" :key="index" :data-row="index+1">
                                                        <td>{{technology.technology_name}}<input type="hidden" name="project_technologies[]" :value="technology.technology_name"/></td>
                                                        <td><a onclick="remove_technology(this)">Remove Technology</a></td>
                                                    </tr>

                                               

                                            </tbody>

                                            <tbody v-else>

                                             </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-edit-previous-btn float-left">Previous</a>
                                            <!-- <a href="javascript:;" class="form-wizard-edit-submit float-right">Submit</a> -->
                                            <button type="submit" class="form-wizard-edit-submit float-right" @click="submitForm" id="formAddProjectSubmit">Submit</button>

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
        props:['projectId'],
        data() {
            return {

                isLoading: true,

                form: {
                  
                },

                validationError: false
            }
        },

        components: {
           
        },

         watch: {

            projectId: function () {
                if(this.projectId != null){

                    this.isLoading = true;

                    let form = {
                        project_id : this.projectId
                    }

                    this.getSingleProject(form).then(() => {

                        console.log(this.singleProject);

                        this.isLoading = false;


                    }).catch(error => {
                    
                        this.isLoading = false;
                        
                        console.log('Something went wrong');

                        
                        
                    });
                }
            },

        },

        mounted () {

            this.getProjectMembers();

            setTimeout(() => {

                jQuery(document).ready(function() {

                    jQuery('.form-wizard-edit-next-btn').click(function() {
                       
                        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                        var currentActiveStep = jQuery(this).parents('.form-wizard-edit').find('.form-wizard-edit-steps .active');
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
                                    $("#dynamic-project-member-view-edit").html("");//Clear area by ID
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
                                                    $('#dynamic-project-member-view-edit').html(response.data);
                                                    
                                                }else{
                                                    $('.message-box').html('<div class="alert alert-danger">Something went wrong</div>');
                                                }
                                        })
                                        .catch(error => {
                                    
                                            alert("Something went wrong");
                                        });

                                }
                                if(jQuery(this).hasClass('show')){

                                    var formAtrr = jQuery(this).attr('data-tab-content');
                                    jQuery(document).find('.form-wizard-edit-steps .form-wizard-edit-step-item').each(function(){
                                        if(jQuery(this).attr('data-attr') == formAtrr){
                                            jQuery(this).addClass('active');
                                            var innerWidth = jQuery(this).innerWidth();
                                            var position = jQuery(this).position();
                                            jQuery(document).find('.form-wizard-edit-step-move').css({"left": position.left, "width": innerWidth});
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

                    var cloneRow = $('.project_members_edit').clone();
                    cloneRow.removeClass('project_members_edit');
                    cloneRow.addClass('remove');
                    cloneRow.show();
                    cloneRow.find('.control-btn').append('<a class="remove-field btn-remove-member" id="btnsave" onclick="remove_member(this)">Remove member</a>');
                    cloneRow.appendTo('.project_members_edit_dynamic');

                });

               window.remove_member= remove_member;

                //Remove project member
                function remove_member(element){
                    $(element).closest('.remove').remove();
                }

                //Add project task
                $('.add-more-task').click(function() {
                    var cloneRow = $('.project_tasks_edit').clone();
                    cloneRow.removeClass('project_tasks_edit');
                    cloneRow.addClass('remove');
                    cloneRow.show();
                    cloneRow.find('.control-btn').append('<a href="#" class="remove-field btn-remove-task" onclick="remove_task(this)">Remove Task</a>');
                    cloneRow.appendTo('.project_tasks_edit_dynamic');

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

                window.add_more_technology_edit= add_more_technology_edit;

                //Add more technologies
                function add_more_technology_edit(){
                    $('.input-error').text("");
                    var technologyused = $("#inputTechnologyUsedEdit").val();

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
                jQuery('.form-wizard-edit-previous-btn').click(function() {
                    var counter = parseInt(jQuery(".wizard-counter").text());;
                    var prev =jQuery(this);
                    var currentActiveStep = jQuery(this).parents('.form-wizard-edit').find('.form-wizard-edit-steps .active');
                    prev.parents('.wizard-fieldset').removeClass("show","400");
                    prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
                    currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
                    jQuery(document).find('.wizard-fieldset').each(function(){
                        if(jQuery(this).hasClass('show')){
                            var formAtrr = jQuery(this).attr('data-tab-content');
                            jQuery(document).find('.form-wizard-edit-steps .form-wizard-edit-step-item').each(function(){
                                if(jQuery(this).attr('data-attr') == formAtrr){
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-edit-step-move').css({"left": position.left, "width": innerWidth});
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
                singleProject: "singleProject",
            })
        },

        methods: {

            ...mapActions({
                updateProject: "updateProject",
                getProjectMembers: "getProjectMembers",
                getSingleProject: "getSingleProject",
            }),

              closeEditDialog(){
                // $( "#editDialogDiv" ).load(window.location.href + " #editDialogDiv" );
               
                // $(".editDialogDiv").contentWindow.location.reload(true);

                
                setTimeout(() => {
                    this.$root.$emit("editProjectModal", false);
                }, 10);
            },

            
            submitForm(e){

                e.preventDefault();


                var form = $('#formEditProjectData'); 
                // let formData = new FormData(form);

                let formData = form.serialize();

                console.log('Submitted');
                console.log(form.serialize());

                // if(this.form.first_name == null || this.form.last_name == null || this.form.user_type == null || this.form.username == null || this.form.password == null || this.form.status == null){
                //     this.validationError = true;
                // }else{

                    // this.validationError = false;
            
                    this.updateProject(formData).then(() => {

                        // form.reset();

                        setTimeout(() => {
                            this.$root.$emit("editProjectModal", false);
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

.form-wizard-edit {
  color: #ffffff;
  padding: 30px;
}
.form-wizard-edit h3{
  color: #27292c;
  text-transform: uppercase;
  border-bottom: 1px solid #27292c;
  padding-bottom: 3px;
}
.form-wizard-edit h5{
  color: #27292c;
}
.form-wizard-edit .wizard-form-radio {
  display: inline-block;
  margin-left: 5px;
  position: relative;
}
.form-wizard-edit .wizard-form-radio input[type="radio"] {
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
.form-wizard-edit .wizard-form-radio input[type="radio"]:focus {
  outline: 0;
}
.form-wizard-edit .wizard-form-radio input[type="radio"]:checked {
  background-color: #fb1647;
}
.form-wizard-edit .wizard-form-radio input[type="radio"]:checked::before {
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
.form-wizard-edit .wizard-form-radio input[type="radio"]:checked::after {
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
.form-wizard-edit .wizard-form-radio input[type="radio"] ~ label {
  padding-left: 10px;
  cursor: pointer;
}
.form-wizard-edit .form-wizard-edit-header {
  text-align: center;
}
.form-wizard-edit .form-wizard-edit-next-btn, .form-wizard-edit .form-wizard-edit-previous-btn, .form-wizard-edit .form-wizard-edit-submit {
  background-color: #fb0;
  color: #ffffff;
  display: inline-block;
  min-width: 100px;
  min-width: 120px;
  padding: 10px;
  text-align: center;
}
.form-wizard-edit .form-wizard-edit-next-btn:hover, .form-wizard-edit .form-wizard-edit-next-btn:focus, .form-wizard-edit .form-wizard-edit-previous-btn:hover, .form-wizard-edit .form-wizard-edit-previous-btn:focus, .form-wizard-edit .form-wizard-edit-submit:hover, .form-wizard-edit .form-wizard-edit-submit:focus {
  color: #ffffff;
  opacity: 0.6;
  text-decoration: none;
}
.form-wizard-edit .wizard-fieldset {
  display: none;
}
.form-wizard-edit .wizard-fieldset.show {
  display: block;
}
.form-wizard-edit .wizard-form-error {
  display: none;
  background-color: #d70b0b;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2px;
  width: 100%;
}
.form-wizard-edit .form-wizard-edit-previous-btn {
  background-color: #fb1647;
}
.form-wizard-edit .form-control {
  font-weight: 300;
  height: auto !important;
  padding: 7px;
  color: #888888;
  background-color: #f1f1f1;
  border: none;
}
.form-wizard-edit .form-control:focus {
  box-shadow: none;
}
.form-wizard-edit .form-group {
  position: relative;
  margin: 5px 0;
}
.form-wizard-edit .wizard-form-text-label {
  position: absolute;
  left: 10px;
  top: 6px;
  transition: 0.2s linear all;
}
.form-wizard-edit .focus-input .wizard-form-text-label {
  color: #fb0;
  top: -18px;
  transition: 0.2s linear all;
  font-size: 12px;
}
.form-wizard-edit .form-wizard-edit-steps {
  margin: 30px 0;
}
.form-wizard-edit .form-wizard-edit-steps li {
  width: 25%;
  float: left;
  position: relative;
}
.form-wizard-edit .form-wizard-edit-steps li::after {
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
.form-wizard-edit .form-wizard-edit-steps li span {
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
.form-wizard-edit .form-wizard-edit-steps li:last-child::after {
  width: 50%;
}
.form-wizard-edit .form-wizard-edit-steps li.active span, .form-wizard-edit .form-wizard-edit-steps li.activated span {
  background-color: #fb0;
  color: #ffffff;
}
.form-wizard-edit .form-wizard-edit-steps li.active::after, .form-wizard-edit .form-wizard-edit-steps li.activated::after {
  background-color: #fb0;
  left: 50%;
  width: 50%;
  border-color: #fb0;
}
.form-wizard-edit .form-wizard-edit-steps li.activated::after {
  width: 100%;
  border-color: #fb0;
}
.form-wizard-edit .form-wizard-edit-steps li:last-child::after {
  left: 0;
}
.form-wizard-edit .wizard-password-eye {
  position: absolute;
  right: 32px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}
</style>

                