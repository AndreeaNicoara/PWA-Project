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
                
                <div class="card mb-4">
                    <div class="card-header" style="color:#fff;">
                        <i class="fas fa-table me-1"></i>
                        Projects List
                    </div>
                    <div class="card-body">
                         <v-data-table
                            :headers="headers"
                            :items="assignedTasks"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                
                                <td>{{ props.index + 1 }}</td>
                                <td class="text-xs-left">{{ props.item.project_task }}</td>
                                <td class="text-xs-left">{{ (props.item.user && props.item.user != null) ? props.item.user.first_name + ' ' + props.item.user.last_name  : 'N/A'}}</td>
                                <td class="text-xs-left">{{ checkProjectStatus(props.item) }}</td>
                                <td class="">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editSingleTask(props.item)"
                                >
                                    edit
                                </v-icon>
                                </td>
                                
                            </template>
                        </v-data-table>
                       
                    </div>
                </div>
            </div>


          

            <!-- Edit task dialog -->
            <div class="text-xs-center">
                <v-dialog
                v-model="editSingleTaskDialog"
                width="60%"
                >
                <v-card>
                    <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    Edit Task User

                    <v-card-actions class="float-position-right ">
                        <v-btn
                        
                        text
                        @click="editSingleTaskDialog = false"
                        class="margin-top-minus-10"
                        >
                        X
                        </v-btn>
                    </v-card-actions>

                    </v-card-title>

                    <v-card-text>
                        <EditSingleTaskForm :taskId="currentSingleTaskId" />
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
    import EditSingleTaskForm from './EditSingleTaskForm'
    import SnackBar from '../Global/SnackBar/SnackBar'

    export default {
        data() {
            return {
                editSingleTaskDialog: false,
                tasks: [],
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        sortable: false,
                        value: 'key'
                    },
                    { text: 'Task', value: 'project_task' },
                    { text: 'Task User', value: 'project_user' },
                    { text: 'Project Status', value: 'status' },
                    { text: 'Action', value: 'action' }
                ],
                currentSingleTaskId: null

              
            }
        },

        components: {
            EditSingleTaskForm,
            SnackBar
        },

        mounted () {

            // console.log(this.$route.params.id);

            this.currentSingleTaskId = this.$route.params.id;

            this.getAssignedTasks(this.currentSingleTaskId);

            this.$root.$on("editSingleTaskModal", text => {
                this.getAssignedTasks(this.currentSingleTaskId);
                this.editSingleTaskDialog = text;
            });
           
        },

        computed: {
            ...mapGetters({
               
                assignedTasks: "assignedTasks",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getAssignedTasks: "getAssignedTasks",
            }),


            editSingleTask(task){
                // this.currentSingleTaskId = task.project_task_id;
                this.editSingleTaskDialog = true;
            },

            checkProjectStatus(item){

                return (item.task_status == "NEW") ? "New" :  (item.task_status == "OPENED") ? "Open" : (item.task_status == "INPROGRESS") ? "In Progress" : (item.task_status == "COMPLETED") ? "Completed" : ""

            },


           
            
        }

    }
</script>
