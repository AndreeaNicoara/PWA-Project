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
   

            <form  method="POST" id="formAddUser" class="lcs-form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputFirstName">First Name <span class="required">*</span></label>
                                <input type="text" class="form-control" id="inputFirstName" v-model="form.first_name" name="first_name">
                                <span class="text-danger input-error first_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputLastName">Last Name <span class="required">*</span></label>
                                <input type="text" class="form-control" id="inputLastName" v-model="form.last_name" name="last_name">
                                <span class="text-danger input-error last_name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputUserType">User Type <span class="required">*</span></label>
                                <select class="form-control" id="inputUserType" v-model="form.user_type" name="user_type">
                                    <option value="">Select User Type</option>
                                    <option value="USER">User</option>
                                    <option value="ADMIN">Admin</option>
                                </select>
                                <span class="text-danger input-error user_type-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputUsername">Username <span class="required">*</span></label>
                                <input type="text" class="form-control" id="inputUsername" v-model="form.username" name="username">
                                <span class="text-danger input-error username-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputPassword">Password <span class="required">*</span></label>
                                <input type="text" class="form-control" id="inputPassword" v-model="form.password" name="password">
                                <span class="text-danger input-error password-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputStatus">Status <span class="required">*</span></label>
                                <select class="form-control" id="inputStatus" v-model="form.status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </select>
                                <span class="text-danger input-error status-error"></span>
                            </div>
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
                            <div class="pull-right">
                                <button type="button" class="btn btn-success form-submit" @click="submit" id="formAddUserSubmit">Submit</button>
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
    import AddUserForm from './AddUserForm'

    export default {
        data() {
            return {
                form: {
                    first_name: null,
                    last_name: null,
                    user_type: null,
                    username: null,
                    password: null,
                    status: null,
                },

                validationError: false
            }
        },

        components: {
           
        },

        mounted () {
           
        },

        computed: {
            ...mapGetters({
               
            })
        },

        methods: {

            ...mapActions({
                addUser: "addUser",
            }),

            submit(){

                if(this.form.first_name == null || this.form.last_name == null || this.form.user_type == null || this.form.username == null || this.form.password == null || this.form.status == null){
                    this.validationError = true;
                }else{

                    this.validationError = false;
            
                    this.addUser(this.form).then(() => {

                        this.form.first_name = null;
                        this.form.last_name = null;
                        this.form.user_type = null;
                        this.form.username = null;
                        this.form.password = null;
                        this.form.status = null;

                        setTimeout(() => {
                            this.$root.$emit("createUserModal", false);
                        }, 10);
                        

                    }).catch(error => {
                    
                        
                        console.log('Something went wrong');
                        
                        
                    });
                    

                 }
            }

          
            
        }

    }
</script>

<!-- 
<script type="text/javascript">

$(document).ready(function(){
    
    //Add user form submit
    var form = $('#formAddUser'); //Get login form variable by ID

    form.on( 'submit', function(e) {
        e.preventDefault();//Stops the default action of a selected element from happening

        $('.input-error').html("");//Clear all the input error messages 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//Pass CSRF token on header using name attribute
            }
        });
 
        $.ajax({
            url     : "{{URL::to('add-user-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/user')}}";
                    }, 1000);
                }else{
                    $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');//Display main form error
                }
            },
            error: function( data ){
                var errors = data.responseJSON;
                //Display response message according to relevant input error message
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.'+key+'-error').html(value);
                });
            }
        });
    });
});
</script> -->


                