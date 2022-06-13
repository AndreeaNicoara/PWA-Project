<template>
    <v-app> 
        <v-content style="background:#1b1b1b">

            <SnackBar></SnackBar>
     
            <div class="container-fluid px-4">
                <h1 class="mt-4" style="color:#fff;">{{pageTitle}}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a style="color:#fb0" href="">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{pageTitle}}</li>
                </ol>
                <!-- <p>{{projectsList}}</p> -->

                <div class="card mb-4">
                    <div class="card-body">
                        <a type="button" class="btn btn-success" @click="addProject()">Add New</a>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header" style="color:#fff;">
                        <i class="fas fa-table me-1"></i>
                        Projects List
                    </div>
                    <div class="card-body">
                         <v-data-table
                            :headers="headers"
                            :items="projectsList"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                
                                <td>{{ props.index + 1 }}</td>
                                <td class="text-xs-left">

                                    <div class="project-title" style="font-weight: bold;color: #27292c;"> {{ props.item.project_name }}</div>
                                    <div class="project-description" style="color: #fb0;">{{ props.item.project_description }}</div>

                                     <div v-if="props.item.tasks && props.item.tasks != null">
                                        <ul style="color:#28a745;">
                                      
                                            
                                                <li @click="navigateToSingle(project_task.project_task_id)" v-for="(project_task, index) in props.item.tasks" :key="index"><a style="text-decoration:underline; color:#fb0;">{{project_task.project_task}}</a></li>
                                                <!-- <li><a href="{{URL::to('project/assign-task/'.$project_task->project_task_id)}}"><?php echo $project_task->project_task;?></li> -->
                                            
                                       
                                        </ul>
                                    </div>
                                   
                                </td>
                                <td class="text-xs-left">{{ props.item.start_date }}</td>
                                <td class="text-xs-left">{{ props.item.end_date }}</td>
                                <td class="text-xs-left">{{ props.item.total_hours }}</td>
                                <td class="text-xs-left">{{ (props.item.user && props.item.user != null) ? props.item.user.first_name + ' ' + props.item.user.last_name  : 'N/A'}}</td>
                                <td class="text-xs-left">{{ (props.item.project_type == "REST_API_MD") ? "Rest API Template - Multimedia Designer" :  (props.item.project_type == "REST_API_WD") ? "Rest API Template - Web Development" : (props.item.project_type == "EMPTY_TEMPLATE") ? "Empty Template" : ""}}</td>
                                <td class="text-xs-left">{{ checkProjectStatus(props.item) }}</td>
                                <td class="text-xs-left">{{ (props.item.status == 0) ? 'Active' : 'Inactive' }}</td>
                                <td class="">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editProject(props.item)"
                                >
                                    edit
                                </v-icon>
                                <v-icon
                                    small
                                    @click="projectDelete(props.item)"
                                >
                                    delete
                                </v-icon>
                                </td>
                                
                            </template>
                        </v-data-table>
                        
                    </div>
                </div>
            </div>


            <!-- Add project dialog -->
            <div class="text-xs-center">
                <v-dialog
                v-model="addProjectDialog"
                width="90%"
                >
                <v-card>
                   
             

                    <v-card-text>
                        <AddProjectForm />
                    </v-card-text>

                </v-card>
                </v-dialog>
            </div>

            <!-- Edit project dialog -->
            <div class="text-xs-center" >
                <v-dialog
                v-model="editProjectDialog"
                 width="90%"
                >
                <v-card>
                    <v-card-text id="editDialogDiv">
                        <EditProjectForm  :projectId="currentProjectId" />
                    </v-card-text>

                </v-card>
                </v-dialog>
            </div>

    
        </v-content>
    </v-app>

</template>

<script>
    
    import { mapGetters, mapActions } from "vuex";
    import store from '../../../store'
    import AddProjectForm from './AddProjectForm'
    import EditProjectForm from './EditProjectForm'
    import SnackBar from '../Global/SnackBar/SnackBar'

    export default {
        data() {
            return {
                addProjectDialog: false,
                editProjectDialog: false,
                projects: [],
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        sortable: true,
                        value: 'key'
                    },
                    { text: 'Project Name', value: 'project_name' },
                    { text: 'Start Date', value: 'start_date' },
                    { text: 'End Date', value: 'end_date' },
                    { text: 'Total Hour(s)', value: 'total_hours' },
                    { text: 'Project Manager', value: 'project_manager' },
                    { text: 'Project Type', value: 'project_type' },
                    { text: 'Project Status', value: 'project_status' },
                    { text: 'Status', value: 'status' },
                    { text: 'Action', value: 'action' }
                ],
                currentProjectId: null

              
            }
        },

        components: {
            AddProjectForm,
            EditProjectForm,
            SnackBar
        },

        mounted () {

            this.getAllProjects();

            this.$root.$on("createProjectModal", text => {
                this.$router.go();
                this.getAllProjects();
                this.addProjectDialog = text;
            });

            this.$root.$on("editProjectModal", text => {
                this.$router.go();
                this.getAllProjects();
                this.editProjectDialog = text;
            });
           
        },

        computed: {
            ...mapGetters({
               
                projectsList: "projectsList",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getAllProjects: "getAllProjects",
                deleteProject: "deleteProject",
            }),

            checkProjectStatus(item){

                var GivenDate = item.end_date;
                var CurrentDate = new Date();
                GivenDate = new Date(GivenDate);

                if(GivenDate < CurrentDate){
                    return "Overdue!";
                }else{

                   return (item.project_status == "NEW") ? "New" :  (item.project_status == "OPENED") ? "Open" : (item.project_status == "INPROGRESS") ? "In Progress" : (item.project_status == "COMPLETED") ? "Completed" : ""

                }


               

            },

          

            addProject(){
                this.addProjectDialog = true;
            },

            editProject(project){
                this.currentProjectId = project.project_id;
                this.editProjectDialog = true;
            },

            navigateToSingle(taskId){
                this.$router.push({ name: "assigntasks", params: {id:taskId}})
            },

            projectDelete(project){

                let form = {
                    project_id: project.project_id
                }

                if(confirm("Are you sure you want to delete this record?")){

                    this.deleteProject(form).then(() => {
                        this.getAllProjects();
                    }).catch(error => {
                         console.log('Something went wrong');
                    });

                }
            }
        }

    }
</script>
