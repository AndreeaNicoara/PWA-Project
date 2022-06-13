<template>
    <!-- <p>{{isShow}}</p> -->
    <div v-if="isShow">

    <EditProjectForm  :projectId="projectId" />
    </div>
</template>


<script>
    
  import EditProjectForm from './EditProjectForm'

    export default {
        props:['projectId','isShow'],
        data() {
            return {

                
            }
        },

        components: {
            EditProjectForm,
        },

        

        mounted () {

          
           
        },
        

       
    }
</script>

                