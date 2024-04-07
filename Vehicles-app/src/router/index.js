import { createRouter, createWebHistory } from 'vue-router'

import AuthLayout from '@/views/AuthLayout.vue';
import Signin from '@/views/Signin.vue';
import Signup from '@/views/Signup.vue';

import Layout from '@/views/Layout.vue';
import Dashboard from '@/views/Dashboard.vue'
import Categories from '@/views/categories/list.vue';
import Add_Edit_Category from '@/views/categories/add_edit.vue' 
import Cars from '@/views/cars/list.vue';
import Add_Edit_Car from '@/views/cars/add_edit.vue' 

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
        // auth user layout
        path:'/',
        component: Layout,
        meta:{
          authUser: true
        },
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: Dashboard,
                meta:{
                    title: 'Dashboard'
                }
            },
            // start category routes
            {
              path: '/categories',
              name: 'categories',
              component: Categories,
              meta:{
                  title: 'Categories'
              }
            },
            {
              path: '/category/add',
              name: 'add-category',
              component: Add_Edit_Category,
              meta:{
                  title: 'New Category'
              }
            },
            {
              path: '/category/:id/edit',
              name: 'edit-category',
              component: Add_Edit_Category,
              meta:{
                  title: 'Edit Category'
              }
            },
            // end category routes

            // start cars routes
            {
              path: '/cars',
              name: 'cars',
              component: Cars,
              meta:{
                  title: 'Cars'
              }
            },
            {
              path: '/car/add',
              name: 'add-car',
              component: Add_Edit_Car,
              meta:{
                  title: 'New Car'
              }
            },
            {
              path: '/car/:id/edit',
              name: 'edit-car',
              component: Add_Edit_Car,
              meta:{
                  title: 'Edit Car'
              }
            },
            // end cars routes
        ],        
    },
    {
      // authentication layout
      path:'/',
      component: AuthLayout,
      meta:{
        authUser: false
      },
      children:[
        {
          path: '/signin',
          name: 'signin',
          component: Signin
        },
        {
          path: '/signup',
          name: 'signup',
          component: Signup
        }
      ],
    },
  ]
});


router.beforeEach((to, from)=>{
      // only for guests
      if (to.meta.authUser && !localStorage.getItem('access_token')) {
          return {name:'signin'};
      }
      // only for auth users
      if(!to.meta.authUser && localStorage.getItem('access_token')){
          return {name:'dashboard'};
      }
});


export default router;