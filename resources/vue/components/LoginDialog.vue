<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useTheme } from 'vuetify'
import { useRouter } from "vue-router";


const response = await axios.get('/api/pw-storage/users');
const users = ref(response.data);

const theme = useTheme()
const isDark = computed(() => theme.global.current.value.dark)

const isOpen = ref(true)

const router = useRouter()

async function handleLogin(credentials, node) {
  try {
    const res = await axios.post('/api/login', credentials)
    router.replace({ name: "home" });
  } catch (error) {
    node.setErrors(
      ['Error']
    )
  }
}
</script>


<template>
  <v-card width="300" class="mx-auto" v-if="isOpen">
    <h3 style="margin: 1em">Log In</h3>
    <v-sheet width="300" class="mx-auto">
      <FormKit type="form" submit-label="Login" @submit="handleLogin" style="margin: 1em">
        <FormKit type="select" label="Email" name="email" :options="users" :input-class="{ dark: isDark }" />
        <FormKit type="text" name="password" label="Password" value="123" disabled :input-class="{ dark: isDark }" />
      </FormKit>
    </v-sheet>
  </v-card>
</template>




