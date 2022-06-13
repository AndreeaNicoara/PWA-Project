import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import DashboardComponent from './components/DashboardComponent'
import UsersComponent from './components/front/Users/UsersComponent'
import ProjectsComponent from './components/front/Projects/ProjectsComponent'
import TasksComponent from './components/front/Tasks/TasksComponent'
import SingleTaskComponent from './components/front/SingleTask/SingleTaskComponent'
import RolesComponent from './components/front/Roles/RolesComponent'
import LoginComponent from './components/LoginComponent'
import RegisterComponent from './components/RegisterComponent'
import LogoutComponent from './components/LogoutComponent'
import Layout from './components/layouts/LayoutComponent'
import store from './store'

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/',
        name: 'home',
        component: Layout,
        meta: { requiresAuth: true },

        children: [
            {
              path: "/dashboard",
              name: 'dashboard',
              component: DashboardComponent,
            },
            {
              path: "/users",
              name: 'users',
              component: UsersComponent,
            },
            {
              path: "/projects",
              name: 'projects',
              component: ProjectsComponent,
            },
            {
              path: "/tasks",
              name: 'tasks',
              component: TasksComponent,
            },
            {
              path: "/assign-task/:id",
              name: 'assigntasks',
              component: SingleTaskComponent,
            },
            {
              path: "/roles",
              name: 'roles',
              component: RolesComponent,
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterComponent
    },
    {
        path: '/logout',
        name: 'logout',
        component: LogoutComponent
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.getters.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.getters.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }

    next()
});

export default router
