import { createApp } from "vue";
import { plugin, defaultConfig } from '@formkit/vue'

import LoginApp from "./LoginApp.vue"


createApp(LoginApp).use(plugin, defaultConfig).mount('#login-app-vue')