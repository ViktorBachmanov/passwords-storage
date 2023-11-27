<script setup>
import { computed } from 'vue'
import { useTheme } from 'vuetify'

import { useAuth } from './composables/useAuth.js'


// import TreeTable from './components/TreeTable.vue'


const theme = useTheme()

function toggleTheme() {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
}

const auth = useAuth();

async function handleLogout() {
  // await axios.post('/logout')
  auth.logout();

  // window.location.reload(true)
}

</script>


<template>
  <!-- <v-card class="mx-auto" max-width="448"> -->
  <v-layout>
    <v-app-bar color="primary" density="compact">
      <v-app-bar-title>Current user: {{ auth.userName }}</v-app-bar-title>
      <template v-slot:append>
        <v-btn icon="mdi-brightness-4" @click="toggleTheme"></v-btn>
        <v-btn v-if="auth.isAuthenticated" icon="mdi-logout" @click="handleLogout"></v-btn>
      </template>
    </v-app-bar>

    <v-main>
      <v-container fluid class="mt-10">
        <Suspense>
          <!-- <TreeTable /> -->
          <RouterView />
        </Suspense>
      </v-container>
    </v-main>

  </v-layout>
  <!-- </v-card> -->
</template>



<style>
.dark {
  color: white;
  background-color: rgb(41, 37, 37);
}
</style>