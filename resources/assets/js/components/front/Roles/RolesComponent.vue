<template>
    <v-app> 
        <v-content style="background:#1b1b1b">

            <SnackBar></SnackBar>
     
            <div class="container-fluid px-4">
                <h1 class="mt-4" style="color:#fff;">{{pageTitle}}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a  style="color:#fb0" href="">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{pageTitle}}</li>
                </ol>
                
                <div class="card mb-4">
                    <div class="card-header" style="color:#fff;">
                        <i class="fas fa-table me-1"></i>
                        Roles Projects List
                    </div>
                    <div class="card-body">
                         <v-data-table
                            :headers="headers"
                            :items="roleProjectsList"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                
                                <td>{{ props.index + 1 }}</td>
                                <td class="text-xs-left">

                                    <div class="project-title" style="font-weight: bold;color: #27292c;"> {{ props.item.project_name }}</div>
                                    <div class="project-description" style="color: #fb0;">{{ props.item.project_description }}</div>

                                    <div v-if="props.item.tasks && props.item.tasks != null">
                                        <ul style="color:#28a745;">
                                      
                                            
                                                <li v-for="(project_task, index) in props.item.tasks" :key="index">{{project_task.project_task}}</li>
                                            
                                       
                                        </ul>
                                    </div>
                                   
                                   
                                </td>
                                <td class="text-xs-left">{{ props.item.start_date }}</td>
                                <td class="text-xs-left">{{ props.item.end_date }}</td>
                                <td class="text-xs-left">{{ props.item.total_hours }}</td>
                                <td class="text-xs-left">{{ (username && username != null) ? username  : 'N/A'}}</td>
                                <td class="text-xs-left">{{ (props.item.project_type == "REST_API_MD") ? "Rest API Template - Multimedia Designer" :  (props.item.project_type == "REST_API_WD") ? "Rest API Template - Web Development" : (props.item.project_type == "EMPTY_TEMPLATE") ? "Empty Template" : ""}}</td>
                                <td class="text-xs-left">{{ checkProjectStatus(props.item) }}</td>
                                <td class="text-xs-left">{{ (props.item.status == 0) ? 'Active' : 'Inactive' }}</td>
                                <td class="">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="viewProject(props.item)"
                                >
                                    visibility
                                </v-icon>
                                </td>
                                
                            </template>
                        </v-data-table>
                      
                    </div>
                </div>
            </div>

            <!-- Edit project dialog -->
            <div class="text-xs-center">
                <v-dialog
                v-model="viewProjectDialog"
                width="40%"
                >
                <v-card>
                    <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    View Role

                        <v-card-actions class="float-position-right ">
                            <v-btn
                            
                            text
                            @click="viewProjectDialog = false"
                            class="margin-top-minus-10"
                            >
                            X
                            </v-btn>
                        </v-card-actions>

                    </v-card-title>

                    <v-card-text>
                        <ViewRoleForm :projectId="currentProjectId" />
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
    import ViewRoleForm from './ViewRoleForm'
    import SnackBar from '../Global/SnackBar/SnackBar'

    export default {
        data() {
            return {
                viewProjectDialog: false,
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
                    { text: 'Leader', value: 'project_manager' },
                    { text: 'Project Type', value: 'project_type' },
                    { text: 'Project Status', value: 'project_status' },
                    { text: 'Status', value: 'status' },
                    { text: 'Action', value: 'action' }
                ],
                currentProjectId: null

              
            }
        },

        components: {
            ViewRoleForm,
            SnackBar
        },

        mounted () {

            this.getAllRoleProjects();

            this.$root.$on("viewProjectModal", text => {
                this.getAllRoleProjects();
                this.viewProjectDialog = text;
            });
           
        },

        computed: {
            ...mapGetters({
               
                roleProjectsList: "roleProjectsList",
                username: "username",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getAllRoleProjects: "getAllRoleProjects",
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

            viewProject(project){
                this.currentProjectId = project.project_id;
                this.viewProjectDialog = true;
            },

        
        }

    }
</script>
