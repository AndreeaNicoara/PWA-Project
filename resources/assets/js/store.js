import Vue from 'vue'
import Vuex from 'vuex'
import router from "./routes"; 

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      //Auth
      isLoggedIn: !!localStorage.getItem('token'),
      token: null,
      user: null,
      username: null,
      is_admin: false,

      //Common
      pageTitle: '',
      isSuccess: false,
      isError: false,
      successMessage: '',
      errorMessage: '',

      //Users
      usersList: [],
      singleUser: [],
      myself: [],

      //projects
      projectsList:[],
      projectManagersList:[],
      singleProject:[],

      //Tasks
      tasksList: [],
      singleTask: [],
      assignedTasks: [],
      assignedUsers: [],

      //Roles
      roleProjectsList: [],
      singleProjectRole: [],

      //Dashboard
      dashboardData: [],
    },

    getters : {
        //Auth
        isLoggedIn: state => !!state.token,
      
        authenticated(state) {
          return state.token && state.user;
        },
        user(state) {
          return state.user;
        },
        isAdmin(state) {
          return state.is_admin;
        },

        //Common
        pageTitle(state) {
          return state.pageTitle;
        },
        isSuccess(state) {
          return state.isSuccess;
        },
        isError(state) {
          return state.isError;
        },
        successMessage(state) {
          return state.successMessage;
        },
        errorMessage(state) {
          return state.errorMessage;
        },

        //Users
        usersList(state) {
          return state.usersList;
        },
        singleUser(state) {
          return state.singleUser;
        },
        username(state) {
          return state.username;
        },
        myself(state) {
          return state.myself;
        },

        //Projects
        projectsList(state) {
          return state.projectsList;
        },
        projectManagersList(state) {
          return state.projectManagersList;
        },
        singleProject(state) {
          return state.singleProject;
        },

        //Tasks
        tasksList(state) {
          return state.tasksList;
        },
        singleTask(state) {
          return state.singleTask;
        },
        assignedTasks(state) {
          return state.assignedTasks;
        },
        assignedUsers(state) {
          return state.assignedUsers;
        },

        //Roles
        roleProjectsList(state) {
          return state.roleProjectsList;
        },
        singleProjectRole(state) {
          return state.singleProjectRole;
        },

        //Dashboard
        dashboardData(state) {
          return state.dashboardData;
        },

        
        

    },

    mutations: {

        //Auth
        loginUser (state) {
            state.isLoggedIn = true
        },
        logoutUser (state) {
            state.isLoggedIn = false
        },

        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, data) {
        state.user = data;
        },
        USERNAME(state, data) {
        state.username = data;
        },
        SET_MYSELF(state, data) {
        state.myself = data;
        },

        //Common
        SET_PAGE_TITLE(state, data){
          state.pageTitle = data;
        },
        SET_IS_SUCCESS(state, data){
          state.isSuccess = data;
        },
        SET_IS_ERROR(state, data){
          state.isError = data;
        },
        SET_IS_SUCCESS_MESSAGE(state, data){
          state.successMessage = data;
        },
        SET_IS_ERROR_MESSAGE(state, data){
          state.errorMessage = data;
        },

        //Users
        SET_USERS_LIST(state, data){
          state.usersList = data;
        },
        
        SET_SINGLE_USER(state, data){
          state.singleUser = data;
        },

        //Projects
        SET_PROJECTS_LIST(state, data){
          state.projectsList = data;
        },
        SET_PROJECTS_MEMBERS(state, data){
          state.projectManagersList = data;
        },
        SET_SINGLE_PROJECT(state, data){
          state.singleProject = data;
        },

        //Tasks
        SET_TASKS_LIST(state, data){
          state.tasksList = data;
        },
        SET_SINGLE_TASK(state, data){
          state.singleTask = data;
        },
        SET_ASSIGNED_TASKS_LIST(state, data){
          state.assignedTasks = data;
        },
        SET_ASSIGN_USERS(state, data){
          state.assignedUsers = data;
        },

        //Roles
        SET_ROLES_LIST(state, data){
          state.roleProjectsList = data;
        },
        SET_SINGLE_ROLE_PROJECT(state, data){
          state.singleProjectRole = data;
        },

        //Dashboard
        SET_DASHBOARD_DATA(state, data){
          state.dashboardData = data;
        },
        


    },
    
   actions : {
    //User Register Action
    async registerUser({commit}, credentials) {
      let response = await axios
        .post("/api/auth/signup-process", credentials)
        .then(response => {

          if(response.data.status == true){

            commit("SET_IS_SUCCESS", true);
            commit("SET_IS_ERROR", false);
            commit("SET_IS_SUCCESS_MESSAGE", response.data.message);

            setTimeout(() => {
              router.push({ name: 'login' })
            }, 1000);


          }else{
            commit("SET_IS_ERROR", true);
            commit("SET_IS_SUCCESS", false);
            commit("SET_IS_ERROR_MESSAGE", 'Something went wrong. Please check the fields');
          }
         
          
         
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          console.log("error message: ", error.message);
        });
    },
    //User Login Action
  
    //User Login Action
    async loginUser({ dispatch, commit }, credentials) {
      let response = await axios.post("/api/auth/login", credentials).catch(error => {

        commit("SET_IS_ERROR", true);
        commit("SET_IS_SUCCESS", false);
        commit("SET_IS_ERROR_MESSAGE", 'Please check your username and password.');
     
        // console.log('error messsage: ', error.message)
      });
      dispatch("attempt", response.data.access_token).then(() => {

        // console.log(response.data);
        // this.$router.push({ path: "/dashboard" });
        router.push({ name: 'dashboard' })
      });
    },
  
    //HandleAuth State
    async attempt({ commit, state }, token) {
      if (token) {

        commit("SET_IS_SUCCESS", true);
        commit("SET_IS_ERROR", false);
        commit("SET_IS_SUCCESS_MESSAGE", 'Logged In Successfully.');

        commit("SET_TOKEN", token);
      }
      if (!state.token) {
        return;
      }
  
      try {
        let response = await axios.get("/api/user", {
          headers: {
            Authorization: "Bearer " + token
          }
        });
        // console.log(response.data)
        // localStorage.setItem("userRole", response.data.roles);

        // localStorage.setItem('token', token)
        // axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem('token')}`;
        
        // commit("IS_ADMIN", response.data);
  
        commit("SET_USER", response.data);
      } catch (e) {
        commit("SET_TOKEN", null);
        commit("SET_USER", null);
        // axios.defaults.headers.common["Authorization"] = null;
        // localStorage.removeItem("token");
      }
    },
    async logout({ commit }) {

        axios.defaults.headers.common["Authorization"] = null;
        localStorage.removeItem("token");
        commit("SET_TOKEN", null);
        commit("SET_USER", null);

        router.push({ name: 'login' })
    },



    //User Details
    async getAllUsers({ commit }) {

      let response = await axios
        .get("/api/front/manage/user")
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("SET_USERS_LIST", response.data.users);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getSingleUser({ commit }, credentials) {

      let response = await axios
        .post("/api/front/edit-user-form", credentials)
        .then(response => {
          // console.log(response.data.user);
          commit("SET_SINGLE_USER", response.data.user);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getMe({ commit }, credentials) {

      let response = await axios
        .get("/api/front/myself")
        .then(response => {
          // console.log(response.data.user);
          commit("SET_MYSELF", response.data);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async addUser({commit}, credentials) {
      let response = await axios
        .post("/api/front/add-user-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data);
          // commit("SET_IS_ERROR_MESSAGE", '');
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          // commit("SET_IS_SUCCESS_MESSAGE", '');
          console.log("error message: ", error.message);
        });
    },

    async updateUser({commit}, credentials) {
      let response = await axios
        .post("/api/front/update-user-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data);
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          console.log("error message: ", error.message);
        });
    },
    
    async deleteUser({commit}, credentials) {
      let response = await axios
      .post("/api/front/delete-user-process", credentials)
      .then(response => {
        commit("SET_IS_SUCCESS", true);
        commit("SET_IS_ERROR", false);
        commit("SET_IS_SUCCESS_MESSAGE", response.data);
        console.log("response: ", response);
      })
      .catch(error => {
        commit("SET_IS_ERROR", true);
        commit("SET_IS_SUCCESS", false);
        commit("SET_IS_ERROR_MESSAGE", error.message);
        console.log("error message: ", error.message);
      });
    },



    //Project Details
    async getAllProjects({ commit }) {

      let response = await axios
        .get("/api/front/manage/project")
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("SET_PROJECTS_LIST", response.data.user_projects);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getSingleProject({ commit }, credentials) {

      let response = await axios
        .post("/api/front/edit-project-form-ajax", credentials)
        .then(response => {
          // console.log(response.data.user);
          commit("SET_SINGLE_PROJECT", response.data);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getProjectMembers({ commit }) {

      let response = await axios
        .post("/api/front/add-project-form-ajax")
        .then(response => {
          commit("SET_PROJECTS_MEMBERS", response.data.project_managers);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getAssignUsers({ commit }, credentials) {

      let response = await axios
        .post("/api/front/project/assign-user-form-ajax", credentials)
        .then(response => {
          commit("SET_ASSIGN_USERS", response.data.task_users);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    
    async addProject({commit}, credentials) {
      let response = await axios
        .post("/api/front/add-project-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data.message);
          // commit("SET_IS_ERROR_MESSAGE", '');
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          // commit("SET_IS_SUCCESS_MESSAGE", '');
          console.log("error message: ", error.message);
        });
    },

    async updateProject({commit}, credentials) {
      let response = await axios
        .post("/api/front/update-project-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data.message);
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          console.log("error message: ", error.message);
        });
    },
    

    async deleteProject({commit}, credentials) {
      let response = await axios
      .post("/api/front/delete-project-process", credentials)
      .then(response => {
        commit("SET_IS_SUCCESS", true);
        commit("SET_IS_ERROR", false);
        commit("SET_IS_SUCCESS_MESSAGE", response.data.message);
        console.log("response: ", response);
      })
      .catch(error => {
        commit("SET_IS_ERROR", true);
        commit("SET_IS_SUCCESS", false);
        commit("SET_IS_ERROR_MESSAGE", error.message);
        console.log("error message: ", error.message);
      });
    },

    //Tasks
    async getAllTasks({ commit }) {

      let response = await axios
        .get("/api/front/manage/task")
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("SET_TASKS_LIST", response.data.tasks);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getAssignedTasks({ commit }, credentials) {

      let response = await axios
        .get("/api/front/project/assign-task/" + credentials)
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("SET_ASSIGNED_TASKS_LIST", response.data.project_task);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getSingleTask({ commit }, credentials) {

      let response = await axios
        .post("/api/front/edit-task-form-ajax", credentials)
        .then(response => {
          // console.log(response.data.user);
          commit("SET_SINGLE_TASK", response.data.task);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async updateTask({commit}, credentials) {
      let response = await axios
        .post("/api/front/update-task-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data.message);
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          console.log("error message: ", error.message);
        });
    },

    async updateTaskUser({commit}, credentials) {
      let response = await axios
        .post("/api/front/project/update-task-user-process", credentials)
        .then(response => {
          commit("SET_IS_SUCCESS", true);
          commit("SET_IS_ERROR", false);
          commit("SET_IS_SUCCESS_MESSAGE", response.data.message);
          console.log("response: ", response);
        })
        .catch(error => {
          commit("SET_IS_ERROR", true);
          commit("SET_IS_SUCCESS", false);
          commit("SET_IS_ERROR_MESSAGE", error.message);
          console.log("error message: ", error.message);
        });
    },

    //Role Project

    async getAllRoleProjects({ commit }) {

      let response = await axios
        .get("/api/front/manage/role")
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("USERNAME", response.data.username);
          commit("SET_ROLES_LIST", response.data.role_projects);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    async getSingleProjectRole({ commit }, credentials) {

      let response = await axios
        .post("/api/front/view-role-form-ajax", credentials)
        .then(response => {
          // console.log(response.data.user);
          commit("SET_SINGLE_ROLE_PROJECT", response.data.role_projects);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },

    //Dashboard
    async getDashboardData({ commit }) {

      let response = await axios
        .post("/api/front/dashboard")
        .then(response => {
          commit("SET_PAGE_TITLE", response.data.page_title);
          commit("SET_DASHBOARD_DATA", response.data);
        })
        .catch(error => {
          console.log("error message: ", error.message);
        });
    },
    
    











  }
})