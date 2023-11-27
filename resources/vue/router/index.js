import { createRouter, createWebHashHistory } from "vue-router";

// import PasswordStorageApp from '../PasswordStorageApp'
import LoginApp from '../LoginApp'
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
      component: LoginApp,
  },
]


const router = createRouter({
  history: createWebHashHistory(),
  routes,
});


export default router;