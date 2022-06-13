<template>
    <div> 
        

        
            <div v-if="isLoading">
                <p>Fetching Data...</p>
            </div>

           <form v-else method="POST" id="formViewRole" class="lcs-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

      
  <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Estimate Hours</th>
                        </tr>
                    </thead>

                    <tbody>
                       <tr
                        v-for="(item, index) in singleProjectRole"
                        :key="item.name"
                        >
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.project_role }}</td>
                        <td>{{ item.estimate_hours }}</td>
                        </tr>
                    </tbody>
                </table>
                       
                         
                    </div>
                    
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

            projectId: function () {
               
                if(this.projectId != null){

                    this.isLoading = true;

                    let form = {
                        project_id : this.projectId
                    }

                    this.getSingleProjectRole(form).then(() => {

                        console.log(this.singleProjectRole);

                      
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
                singleProjectRole: "singleProjectRole",
            })
        },

        methods: {

            ...mapActions({
                getSingleProjectRole: "getSingleProjectRole",
            }),

            
        }

    }
</script>


                