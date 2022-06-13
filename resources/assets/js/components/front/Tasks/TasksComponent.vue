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
                        Tasks List
                    </div>
                    <div class="card-body">
                         <v-data-table
                            :headers="headers"
                            :items="tasksList"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                
                                <td>{{ props.index + 1 }}</td>
                                <td class="text-xs-left">{{ props.item.project_task }}</td>
                                <td class="text-xs-left">{{ props.item.project_name }}</td>
                                <td class="text-xs-left">{{ checkProjectStatus(props.item) }}</td>
                                <td class="">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editTask(props.item)"
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
                v-model="editTaskDialog"
                width="60%"
                >
                <v-card>
                    <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    Edit Task

                    <v-card-actions class="float-position-right ">
                        <v-btn
                        
                        text
                        @click="editTaskDialog = false"
                        class="margin-top-minus-10"
                        >
                        X
                        </v-btn>
                    </v-card-actions>

                    </v-card-title>

                    <v-card-text>
                        <EditTaskForm :taskId="currentTaskId" />
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
    import EditTaskForm from './EditTaskForm'
    import SnackBar from '../Global/SnackBar/SnackBar'

    export default {
        data() {
            return {
                editTaskDialog: false,
                tasks: [],
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        sortable: false,
                        value: 'key'
                    },
                    { text: 'Task Name', value: 'project_task' },
                    { text: 'Project', value: 'project_name' },
                    { text: 'Status', value: 'status' },
                    { text: 'Action', value: 'action' }
                ],
                currentTaskId: null

              
            }
        },

        components: {
            EditTaskForm,
            SnackBar
        },

        mounted () {

            this.getAllTasks();

            this.$root.$on("editTaskModal", text => {
                this.getAllTasks();
                this.editTaskDialog = text;
            });
           
        },

        computed: {
            ...mapGetters({
               
                tasksList: "tasksList",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getAllTasks: "getAllTasks",
            }),


            editTask(task){
                this.currentTaskId = task.project_task_id;
                this.editTaskDialog = true;
            },

            checkProjectStatus(item){

                return (item.task_status == "NEW") ? "New" :  (item.task_status == "OPENED") ? "Open" : (item.task_status == "INPROGRESS") ? "In Progress" : (item.task_status == "COMPLETED") ? "Completed" : ""

            },


           
            
        }

    }
</script>
