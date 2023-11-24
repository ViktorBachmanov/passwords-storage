import { createApp } from "vue";
import TestApp from "./TestApp.vue";

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})

const testApp = createApp(TestApp);

testApp.use(vuetify).mount("#test-vue-app");