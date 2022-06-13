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
   

           <form  method="POST" id="formUpdateSingleTask" class="lcs-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="inputTaskStatus">User <span class="required">*</span></label>
                            <input type="hidden" class="form-control" id="inputProjectTaskId" name="project_task_id" value="121212">
                            <!-- <input type="hidden" class="form-control" id="inputProjectTaskId" name="project_task_id" value="{{$task->project_task_id}}"> -->
                            
                            <select class="form-control" id="inputTaskStatus" name="user_id" v-model="form.user_id">
                                <option value=""></option>
                                <option v-for="(userData, index) in assignedUsers" :key="index" :value="userData.id">{{userData.first_name + ' ' + userData.last_name}}</option>

                                
                               
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
                    user_id: null,
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

                    
                    this.getAssignUsers(form).then(() => {

                      
                      
                        this.getSingleTask(form).then(() => {

                            console.log(this.singleTask);

                            if(this.singleTask && this.singleTask != null){

                                this.form.user_id = this.singleTask.user_id

                            }else{
                                this.form.user_id = "NEW"
                            }
                        
                        
                            this.isLoading = false;


                        }).catch(error => {
                        
                            this.isLoading = false;
                            
                            console.log('Something went wrong');

                            
                            
                        });


                    }).catch(error => {
                    
            
                        
                        console.log('Something went wrong');

                        
                        
                    });




                  
                }
            },

        },

        computed: {
            ...mapGetters({
                singleTask: "singleTask",
                assignedUsers: "assignedUsers",
            })
        },

        methods: {

            ...mapActions({
                getSingleTask: "getSingleTask",
                getAssignUsers: "getAssignUsers",
                updateTaskUser: "updateTaskUser",
            }),

            submit(){
               if(this.form.user_id == null){
                    this.validationError = true;
                }else{

                    this.validationError = false;

                    let form = {
                        project_task_id: this.taskId,
                        user_id: this.form.user_id
                    }
            
                    this.updateTaskUser(form).then(() => {

                        setTimeout(() => {
                            this.$root.$emit("editSingleTaskModal", false);
                        }, 10);
                        

                    }).catch(error => {
                    
                        
                        console.log('Something went wrong');
                        
                        
                    });
                    

                }
           
            }
            

          
            
        }

    }
</script>


                