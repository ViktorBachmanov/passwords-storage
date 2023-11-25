import { createApp } from "vue";
import PasswordsStorageApp from "./PasswordsStorageApp.vue";

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})


createApp(PasswordsStorageApp).use(vuetify).mount("#passwords-storage-app-vue");