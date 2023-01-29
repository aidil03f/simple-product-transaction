import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import About from "../views/About";
import Contact from "../views/Contact";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import Product from "../views/product/Table";
import ProductCreate from "../views/product/Create";
import ProductEdit from "../views/product/Edit";
import Transaction from "../views/transaction/Table";
import TransactionCreate from "../views/transaction/Create";
import TransactionEdit from "../views/transaction/Edit";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    component: About,
  },
  {
    path: "/contact",
    name: "Contact",
    component: Contact,
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
  {
    path: "/products",
    name: "product.index",
    component: Product,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
  {
    path: "/create-product",
    name: "product.create",
    component: ProductCreate,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
  {
    path: "/products/:id",
    name: "product.edit",
    component: ProductEdit,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
  {
    path: "/transactions",
    name: "transaction.index",
    component: Transaction,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
  {
    path: "/create-transaction",
    name: "transaction.create",
    component: TransactionCreate,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
  {
    path: "/transaction/:id",
    name: "transaction.edit",
    component: TransactionEdit,
    beforeEnter: (to, from, next) => {
      const token = localStorage.getItem("token");
      if (!token) {
        return next({ name: "login" });
      }
      next();
    },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
  linkActiveClass: "active",
});

export default router;
