import { createApp } from "vue";
import { plugin, defaultConfig } from '@formkit/vue'
import '@formkit/themes/genesis'
import { createPinia } from 'pinia'
import axios from 'axios'

import PasswordsStorageApp from "./PasswordsStorageApp.vue";

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import router from "./router/index.js";

axios.interceptors.response.use(
  (res) => res,
  (error) => {
      if ([401, 419].includes(error.response.status)) {
          router.replace({ name: "login" });
      } else {
          return Promise.reject(error);
      }
  }
);

const vuetify = createVuetify({
  components,
  directives,
  theme: {
    defaultTheme: 'dark'
  }
})

const pinia = createPinia()

const mountEl = document.getElementById('passwords-storage-app-vue')

createApp(PasswordsStorageApp, {
  itemEnum: JSON.parse(mountEl.dataset.itemEnum)
})
  .use(vuetify)
  .use(plugin, defaultConfig)
  .use(pinia)
  .use(router)
  .mount(mountEl);