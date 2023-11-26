import { createApp } from "vue";
import { plugin, defaultConfig } from '@formkit/vue'
import '@formkit/themes/genesis'
import { createPinia } from 'pinia'

import PasswordsStorageApp from "./PasswordsStorageApp.vue";

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

const pinia = createPinia()

createApp(PasswordsStorageApp)
  .use(vuetify)
  .use(plugin, defaultConfig)
  .use(pinia)
  .mount("#passwords-storage-app-vue");