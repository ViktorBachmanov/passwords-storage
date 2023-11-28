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

function handleClose() {
  isOpen.value = false
}

const router = useRouter()

async function handleLogin(credentials, node) {
  try {
    const res = await axios.post('/api/login', credentials)
    // handleClose();
    // window.location.replace('/pw-storage')
    router.replace({ name: "home" });
  } catch (error) {
    node.setErrors(
      ['Error']
    )
  }
}
</script>


<template>
  <!-- <v-dialog v-model="isOpen" width="auto"> -->
  <v-card width="300" class="mx-auto" v-if="isOpen">
    <h3>Log In</h3>
    <v-sheet width="300" class="mx-auto">
      <FormKit type="form" submit-label="Login" @submit="handleLogin" style="margin: 1em">
        <!-- <FormKit name="email" label="Email address" validation="required|email" /> -->
        <FormKit type="select" label="Email" name="email" :options="users" :input-class="{ dark: isDark }" />
        <FormKit type="text" name="password" label="Password" value="123" disabled :input-class="{ dark: isDark }" />
      </FormKit>
    </v-sheet>
    <!-- </v-dialog> -->
  </v-card>
</template>




