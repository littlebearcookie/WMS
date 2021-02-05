import Vue from "vue";
import Router from "vue-router";

// 引用頁面的 Component
import Home from "./views/Home.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import User from "./views/User.vue";
import Wedding from "./views/Wedding.vue";
import AddWedding from "./views/AddWedding.vue";
import EditWedding from "./views/EditWedding.vue";
import Guest from "./views/Guest.vue";
import Form from "./views/Form.vue";
import AddForm from "./views/AddForm.vue";
import EditForm from "./views/EditForm.vue";
import PreviewForm from "./views/PreviewForm.vue";

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
    // Edit wedding
    {
      path: "/editWedding/:wedding_id",
      name: "EditWedding",
      component: EditWedding,
      meta: { requireAuth: true }
    },
    // Guest
    {
      path: "/guest/:wedding_id?",
      name: "Guest",
      component: Guest,
      meta: { requireAuth: true }
    },
    // Form
    {
      path: "/form",
      name: "Form",
      component: Form,
      meta: { requireAuth: true }
    },
    // Add form
    {
      path: "/addForm",
      name: "AddForm",
      component: AddForm,
      meta: { requireAuth: true }
    },
    // Edit form
    {
      path: "/editForm/:form_id",
      name: "EditForm",
      component: EditForm,
      meta: { requireAuth: true }
    },
    // Preview form
    {
      path: "/form/preview/:form_id",
      name: "PreviewForm",
      component: PreviewForm,
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
