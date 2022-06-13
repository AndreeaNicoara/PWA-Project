<template>
    <v-app> 
        <v-content style="background:#1b1b1b">

    <div class="container-fluid px-4">
    <h1 class="mt-4" style="color:#fff;">{{ dashboardData.page_title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ dashboardData.page_title }}</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">New Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" >Count {{(dashboardData.new_tasks_count && dashboardData.new_tasks_count != null) ? dashboardData.new_tasks_count : 0}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Open Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" >Count {{(dashboardData.open_tasks_count && dashboardData.open_tasks_count != null) ? dashboardData.open_tasks_count : 0}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">In Progress Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" >Count {{(dashboardData.inprogress_tasks_count && dashboardData.inprogress_tasks_count != null) ? dashboardData.inprogress_tasks_count : 0}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Completed Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" >Count {{(dashboardData.completed_tasks_count && dashboardData.completed_tasks_count != null) ? dashboardData.completed_tasks_count : 0}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="card mb-4">
        <div class="card-header" style="color:#fff;">
            <i class="fas fa-table me-1"></i>
            My Pending Tasks List
        </div>
        <div class="card-body">
                <v-data-table
                    :headers="headers"
                    :items="dashboardData.pending_tasks"
                    class="elevation-1"
                >
                    <template slot="items" slot-scope="props">
        
                        <td>{{ props.index + 1 }}</td>
                        <td class="text-xs-left">{{ props.item.project_task }}</td>
                        <td class="text-xs-left">{{ props.item.project_name }}</td>
                        <td class="text-xs-left">{{ props.item.start_date }}</td>
                        <td class="text-xs-left">{{ props.item.end_date }}</td>
                        <td class="text-xs-left">{{ checkProjectStatus(props.item) }}</td>
                       
                        
                    </template>
                </v-data-table>
        </div>
    </div>
</div>

  </v-content>
    </v-app>


</template>

<script>

    import { mapGetters, mapActions } from "vuex";

    export default {
        data() {
            return {
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        sortable: false,
                        value: 'key'
                    },
                    { text: 'Task Name', value: 'project_task' },
                    { text: 'Project', value: 'project_name' },
                    { text: 'Start Date', value: 'start_date' },
                    { text: 'End Date', value: 'end_date' },
                    { text: 'Status', value: 'status' },
                   
                ],
            }
        },
        mounted() {

            this.getDashboardData();
           
        },

         computed: {
            ...mapGetters({
               
                dashboardData: "dashboardData",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getDashboardData: "getDashboardData",
            }),


            checkProjectStatus(item){

                return (item.task_status == "NEW") ? "New" :  (item.task_status == "OPENED") ? "Open" : (item.task_status == "INPROGRESS") ? "In Progress" : (item.task_status == "COMPLETED") ? "Completed" : ""

            },
            
        }
    }
</script>
