import Vue from "vue";
import Router from "vue-router";

// 引用頁面的 Component
import Home from "./views/Home.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import User from "./views/User.vue";
import Wedding from "./views/Wedding.vue";
import Guest from "./views/Guest.vue";
import AddWedding from "./views/AddWedding.vue";
import AddQuestion from "./views/AddQuestion.vue";

// 使用 Vue Router
Vue.use(Router);

var router = new Router({
  routes: [
    // Home
    {
      path: "/",
      name: "Home",
      component: Home,
      meta: { requireAuth: true }
    },
    // Login
    {
      path: "/login",
      name: "Login",
      component: Login
    },
    // Register
    {
      path: "/register",
      name: "Register",
      component: Register
    },
    // User profile
    {
      path: "/user",
      name: "User",
      component: User,
      meta: { requireAuth: true }
    },
    // Wedding
    {
      path: "/wedding",
      name: "Wedding",
      component: Wedding,
      meta: { requireAuth: true }
    },
    // Add wedding
    {
      path: "/addWedding",
      name: "AddWedding",
      component: AddWedding,
      meta: { requireAuth: true }
    },
    // Add question
    {
      path: "/addQuestion",
      name: "AddQuestion",
      component: AddQuestion,
      meta: { requireAuth: true }
    },
    // Guest
    {
      path: "/guest/:wedding_id?",
      name: "Guest",
      component: Guest,
      meta: { requireAuth: true }
    }
  ]
});
router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth) {
    if (localStorage.getItem("access_token")) {
      next();
    } else {
      next({
        name: "Login"
      });
    }
  } else {
    next(); // make sure to always call next()!
  }
});
export default router;
