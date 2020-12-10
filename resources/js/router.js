import Vue from 'vue';
import Router from 'vue-router';

// 引用頁面的 Component
import Home from './components/Home.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import User from './components/User.vue';
import Wedding from './components/Wedding.vue';

// 使用 Vue Router
Vue.use(Router);

var router = new Router({
  routes: [
    // Home
    {
      path: '/',
      name: 'Home',
      component: Home,
      meta: { requireAuth: true }
    },
    // Login
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    // Register
    {
      path: '/register',
      name: 'Register',
      component: Register,
    },
    // User profile
    {
      path: '/user',
      name: 'User',
      component: User,
      meta: { requireAuth: true }
    },
    // Wedding profile
    {
      path: '/wedding',
      name: 'Wedding',
      component: Wedding,
      meta: { requireAuth: true }
    },
  ]
});
router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth) {
    if (localStorage.getItem("access_token")) {
      next();
    }
    else {
      next({
        name: 'Login',
      });
    }
  } else {
    next() // make sure to always call next()!
  }
})
export default router;