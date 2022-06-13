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
                    <div class="card-body">
                        <a type="button" class="btn btn-success" @click="addUser()">Add New</a>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header" style="color:#fff;">
                        <i class="fas fa-table me-1"></i>
                        Users List
                    </div>
                    <div class="card-body">
                         <v-data-table
                            :headers="headers"
                            :items="usersList"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                
                                <td>{{ props.index + 1 }}</td>
                                <td class="text-xs-left">{{ props.item.first_name }}</td>
                                <td class="text-xs-left">{{ props.item.last_name }}</td>
                                <td class="text-xs-left">{{ props.item.user_type }}</td>
                                <td class="text-xs-left">{{ (props.item.status == 0) ? 'Active' : 'Inactive' }}</td>
                                <td class="">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editUser(props.item)"
                                >
                                    edit
                                </v-icon>
                                <v-icon
                                    small
                                    @click="userDelete(props.item)"
                                >
                                    delete
                                </v-icon>
                                </td>
                                
                            </template>
                        </v-data-table>
                        
                    </div>
                </div>
            </div>


            <!-- Add user dialog -->
            <div class="text-xs-center">
                <v-dialog
                v-model="addUserDialog"
                width="60%"
                >
                <v-card>
                    <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    Add User

                      <v-card-actions class="float-position-right ">
                            <v-btn
                            
                            text
                            @click="addUserDialog = false"
                            class="margin-top-minus-10"
                            >
                            X
                            </v-btn>
                        </v-card-actions>

                    </v-card-title>

                    <v-card-text>
                        <AddUserForm />
                    </v-card-text>

                    

                </v-card>
                </v-dialog>
            </div>

            <!-- Edit user dialog -->
            <div class="text-xs-center">
                <v-dialog
                v-model="editUserDialog"
                width="60%"
                >
                <v-card>
                    <v-card-title
                    class="headline grey lighten-2"
                    style="color: #fff;"
                    primary-title
                    >
                    Edit User

                      <v-card-actions class="float-position-right ">
                            <v-btn
                            
                            text
                            @click="editUserDialog = false"
                            class="margin-top-minus-10"
                            >
                            X
                            </v-btn>
                        </v-card-actions>


                    </v-card-title>

                    <v-card-text>
                        <EditUserForm :userId="currentUserId" />
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
    import AddUserForm from './AddUserForm'
    import EditUserForm from './EditUserForm'
    import SnackBar from '../Global/SnackBar/SnackBar'

    export default {
        data() {
            return {
                addUserDialog: false,
                editUserDialog: false,
                users: [],
                headers: [
                    {
                        text: '#',
                        align: 'left',
                        sortable: false,
                        value: 'key'
                    },
                    { text: 'First Name', value: 'first_name' },
                    { text: 'Last Name', value: 'last_name' },
                    { text: 'User Type', value: 'user_type' },
                    { text: 'Status', value: 'status' },
                    { text: 'Action', value: 'action' }
                ],
                currentUserId: null

              
            }
        },

        components: {
            AddUserForm,
            EditUserForm,
            SnackBar
        },

        mounted () {

            this.getAllUsers();

            this.$root.$on("createUserModal", text => {
                this.getAllUsers();
                this.addUserDialog = text;
            });

            this.$root.$on("editUserModal", text => {
                this.getAllUsers();
                this.editUserDialog = text;
            });
           
        },

        computed: {
            ...mapGetters({
               
                usersList: "usersList",
                pageTitle: "pageTitle",
                
            })
        },

        methods: {

            ...mapActions({
                getAllUsers: "getAllUsers",
                deleteUser: "deleteUser",
            }),

            addUser(){
                this.addUserDialog = true;
            },

            editUser(user){
                this.currentUserId = user.id;
                this.editUserDialog = true;
            },

            userDelete(user){

                let form = {
                    user_id: user.id
                }

                if(confirm("Are you sure you want to delete this record?")){

                    this.deleteUser(form).then(() => {
                        this.getAllUsers();
                    }).catch(error => {
                         console.log('Something went wrong');
                    });

                }
            }
            
        }

    }
</script>
