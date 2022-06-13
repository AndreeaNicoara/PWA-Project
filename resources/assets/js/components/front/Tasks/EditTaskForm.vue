<template>
    <div> 
     

            <div v-if="validationError">

                <v-alert
                    v-model="validationError"
                    dismissible
                    type="error"
                    >
                    Please fill all required fields.
                </v-alert>
                
            </div>

            <div v-if="isLoading">
                <p>Fetching Data...</p>
            </div>
   

           <form  method="POST" id="formUpdateTask" class="lcs-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="inputTaskStatus">Task Status <span class="required">*</span></label>
                            <input type="hidden" class="form-control" id="inputProjectTaskId" name="project_task_id" value="121212">
                            <!-- <input type="hidden" class="form-control" id="inputProjectTaskId" name="project_task_id" value="{{$task->project_task_id}}"> -->
                            
                            <select class="form-control" id="inputTaskStatus" name="task_status" v-model="form.task_status">
                                <option value="">Select Status</option>
                                <option value="NEW">New</option>
                                <option value="OPENED">Open</option>
                                <option value="INPROGRESS">In Progress</option>
                                <option value="COMPLETED">Completed</option>
                                <!-- <option value="COMPLETED" <?php if($task->task_status == "COMPLETED"){ echo "selected";}?>>Completed</option> -->
                            </select>
                            <span class="text-danger input-error status-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                </div>

                

            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="message-box" style="text-align:center;">
                            
                        </div>
                    </div>
                </div>

                

                
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pull-right">
                            <button type="button" @click="submit" class="btn btn-success form-submit" id="formUpdateProjectSubmit">Submit</button>
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
        props:['taskId'],
        data() {
            return {

                isLoading: true,

                form: {
                    task_status: null,
                },

                validationError: false
            }
        },

        components: {
           
        },

        mounted () {

          
           
        },

        watch: {

            taskId: function () {
               
                if(this.taskId != null){

                    this.isLoading = true;

                    let form = {
                        project_task_id : this.taskId
                    }

                    this.getSingleTask(form).then(() => {

                        console.log(this.singleTask);

                        if(this.singleTask && this.singleTask != null){

                            this.form.task_status = this.singleTask.task_status

                        }else{
                            this.form.task_status = "NEW"
                        }
                     
                      
                        this.isLoading = false;


                    }).catch(error => {
                    
                        this.isLoading = false;
                        
                        console.log('Something went wrong');

                        
                        
                    });
                }
            },

        },

        computed: {
            ...mapGetters({
                singleTask: "singleTask",
            })
        },

        methods: {

            ...mapActions({
                getSingleTask: "getSingleTask",
                updateTask: "updateTask",
            }),

            submit(){
               if(this.form.task_status == null){
                    this.validationError = true;
                }else{

                    this.validationError = false;

                    let form = {
                        project_task_id: this.taskId,
                        task_status: this.form.task_status
                    }
            
                    this.updateTask(form).then(() => {

                        setTimeout(() => {
                            this.$root.$emit("editTaskModal", false);
                        }, 10);
                        

                    }).catch(error => {
                    
                        
                        console.log('Something went wrong');
                        
                        
                    });
                    

                }
           
            }
            

          
            
        }

    }
</script>


                