import { createApp } from "vue";
import { plugin, defaultConfig } from '@formkit/vue'
import '@formkit/themes/genesis'

import LoginApp from "./LoginApp.vue"


createApp(LoginApp).use(plugin, defaultConfig).mount('#login-app-vue')