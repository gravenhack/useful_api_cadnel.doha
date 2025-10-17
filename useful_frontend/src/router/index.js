
import { createRouter, createWebHistory } from 'vue-router';
import AuthLogin from '../views/AuthLogin.vue';
import AuthRegister from '../views/AuthRegister.vue';
import MiniDashboard from '../views/MiniDashboard.vue';

const routes = [
  {
    path: '/auth/login',
    name: 'Login',
    component: AuthLogin
  },
  {
    path: '/auth/register',
    name: 'Register',
    component: AuthRegister
  },
  {
    path: '/',
    name: 'Dashboard',
    component: MiniDashboard
  },
  

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;



