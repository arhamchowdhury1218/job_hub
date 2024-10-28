import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import JobsView from "@/views/JobsView.vue";
import NotFoundView from "@/views/NotFoundView.vue";
import JobView from "@/views/JobView.vue";
import AddJobView from "@/views/AddJobView.vue";
import EditJobView from "@/views/EditJobView.vue";
import SignUpView from "@/views/SignUpView.vue";
import SignInView from "@/views/SignInView.vue";
import DashboardView from "@/views/DashboardView.vue";
import JobsAddedView from "@/views/JobsAppliedView.vue";
import ApplyJobView from "@/views/ApplyJobView.vue";
import JobsAppliedView from "@/views/JobsAppliedView.vue";
import JobApplicantsView from "@/views/JobApplicantsView.vue";




const router = createRouter({

    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
        },

        {
            path: '/jobs',
            name: 'jobs',
            component: JobsView,
        },

        {
            path: '/jobs/:id',
            name: 'job',
            component: JobView,
        },

        {
            path: '/jobs/add',
            name: 'add-job',
            component: AddJobView,
        },


        {
            path: '/jobs/edit/:id',
            name: 'edit-job',
            component: EditJobView,

        },


        {
            path: '/signup',
            name: 'signup',
            component: SignUpView,
        },

        {
            path: '/signin',
            name: 'signin',
            component: SignInView,
        },

        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardView,
        },

       
        {
            path: '/jobs/:id/applied', 
            name: 'jobs-applied',
            component: JobsAppliedView,
        },
        

        {
            path: '/:catchAll(.*)',
            name: 'not-found',
            component: NotFoundView,
        },

        {
            path: '/jobs/apply/:id',
            name: 'apply-job',
            component: ApplyJobView, // Ensure this component is imported and defined
        },
        

        {
            path: '/jobs/:id/applicants',
            name: 'job-applicants',
            component: JobApplicantsView, 
        }
        
    ],
});

export default router;