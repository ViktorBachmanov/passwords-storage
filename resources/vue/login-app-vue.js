import { createApp } from "vue";
import { plugin, defaultConfig } from '@formkit/vue'
import '@formkit/themes/genesis'

import LoginApp from "./LoginApp.vue"

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
  theme: {
    defaultTheme: 'dark'
  }
})


createApp(LoginApp).use(vuetify).use(plugin, defaultConfig).mount('#login-app-vue')