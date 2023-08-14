import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import {useAuthStore} from '../stores/auth';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path:'/app',
    //   name:'app',
    //   component:AppLayout,
    //   meta:{
    //     requiredAuth:true
    //   },
    //   children:[
    //     {
    //       path:'dashboard',
    //       name:'app.dashboard',
    //       component:()=>import('../views/app/Dashboard.vue')
    //     }
    //     ,{
    //       path:'skills',
    //       name:'app.skills',
    //       component:()=>import('../views/skills/SkillIndex.vue')
    //     }
    //   ]

    // },
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/skills',
      name: 'skillIndex',
      component: () => import('../views/skills/SkillIndex.vue')
    },
    {
      path: '/skills/create',
      name: 'SkillCreate',
      component: () => import('../views/skills/SkillCreate.vue')
    },
    {
      path: '/skills/:id/edit',
      name: 'SkillEdit',
      component: () => import('../views/skills/SkillEdit.vue'),
      props:true,
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('../views/auth/Login.vue'),
      meta:{
        requiresGuest:true
      }
    },
    {
      path: '/request-password',
      name: 'RequestPassword',
      component: () => import('../views/auth/RequestPassword.vue'),
      meta:{
        requiresGuest:true
      }
    },
    {
      path: '/reset-password/:token',
      name: 'ResetPassword', 
      // component: () => import('../views/auth/ResetPassword.vue'),
    }
  ]
})

router.beforeEach((to, from, next) => {
  const authUser = useAuthStore();
  if(to.meta.requiredAuth && !authUser.user.token){
    next({name:'Login'});
  }
  else if(to.meta.requiresGuest && authUser.user.token){
    next({name:'app.dashboard'});
  }else{
    next();
  }
})


export default router
