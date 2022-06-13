<template>


   <div>
       
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">PMS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" @click="changeSideBar" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class=" d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><router-link class="dropdown-item" :to="{ name: 'logout' }">Logout</router-link></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <router-link class="nav-link" :to="{ name: 'dashboard' }">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                           </router-link>

                            
                            <div class="sb-sidenav-menu-heading">Project</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMyProjects" aria-expanded="false" aria-controls="collapseMyProjects">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                My Projects
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMyProjects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    
                                    
                                    
                                    <router-link class="nav-link" :to="{ name: 'roles' }">
                                        <a class="nav-link" href="">Roles</a>
                                    </router-link>

                                    <router-link class="nav-link" :to="{ name: 'tasks' }">
                                        <a class="nav-link">Tasks</a>
                                    </router-link>
                                   
                                    
                                </nav>
                            </div>
                            
                            
                            
                            
                            <div v-if="this.myself && this.myself != null && this.myself.user_type == 'ADMIN'">
                                <div class="sb-sidenav-menu-heading">SETTING</div>
                                <router-link class="nav-link" :to="{ name: 'users' }">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Users
                            </router-link>
                            
                                <router-link class="nav-link" :to="{ name: 'projects' }">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                    Projects
                                </router-link>
                            </div>
                            
                            
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                      
                        {{this.myself && this.myself != null ? this.myself.first_name + ' ' + this.myself.last_name : ''}}
                     
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                     <router-view></router-view>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <!-- <div class="text-muted">Copyright &copy; PMS <?php echo date("Y")?></div> -->
                            <div class="text-muted">Copyright &copy; PMS {{getYear()}}</div>
                            <div>
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade common_modal" id="common_modal" tabindex="-1" role="dialog" aria-labelledby="common_modal_label" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="common_modal_label">Modal title</h5>
                <button type="button" class="close" onclick="hide_modal(this)">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">

              </div>
            </div>
          </div>
        </div>
      
   </div>

  
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
         data() {
            return {
               
            };
        },

        mounted(){
            this.getMe();


            window.addEventListener('DOMContentLoaded', event => {

                //Toggle the side navigation
                const sidebarToggle = document.body.querySelector('#sidebarToggle');
                if (sidebarToggle) {
                    //Uncomment Below to persist sidebar toggle between refreshes
                    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                    document.body.classList.toggle('sb-sidenav-toggled');
                    }
                    sidebarToggle.addEventListener('click', event => {
                        event.preventDefault();
                        document.body.classList.toggle('sb-sidenav-toggled');
                        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                    });
                }

            });

        },

        methods: {

            ...mapActions({
                getMe: "getMe",
            }),

            getYear(){
                const currentYear = new Date().getFullYear();
                return currentYear;
            },
            
            changeSideBar(){
                const sidebarToggle = document.body.querySelector('#sidebarToggle');
                if (sidebarToggle) {
                    //Uncomment Below to persist sidebar toggle between refreshes
                    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                    document.body.classList.toggle('sb-sidenav-toggled');
                    }
                    sidebarToggle.addEventListener('click', event => {
                        event.preventDefault();
                        document.body.classList.toggle('sb-sidenav-toggled');
                        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                    });
                }
            },
        },

        computed: {
            ...mapGetters({
               
                myself: "myself",
              
                
            })
        },

        created() {

        

        }
    }
</script>
