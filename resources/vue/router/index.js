import { createRouter, createWebHashHistory } from "vue-router";

// import PasswordStorageApp from '../PasswordStorageApp'
import LoginDialog from '../components/LoginDialog'
import TreeTable from '../components/TreeTable'

const routes = [
  {
      path: "/",
      name: "home",
      component: TreeTable,
  },
  {
      path: "/login",
      name: "login",
      component: LoginDialog,
  },
]


const router = createRouter({
  history: createWebHashHistory(),
  routes,
});


export default router;