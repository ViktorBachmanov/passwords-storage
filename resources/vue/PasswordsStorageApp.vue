<script setup>
import { useTheme } from 'vuetify'

import { useAuth } from './composables/useAuth.js'
import { useTreeStore } from './stores/tree-store.js'


const theme = useTheme()

function toggleTheme() {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
}

const auth = useAuth()

const treeStore = useTreeStore()

async function handleLogout() {
  auth.logout()
  treeStore.reset()
}

</script>


<template>
  <!-- <v-card class="mx-auto" max-width="448"> -->
  <v-layout>
    <v-app-bar color="primary" density="compact">
      <v-app-bar-title>Current user: {{ auth.userName }}</v-app-bar-title>
      <v-btn v-if="auth.isAuthenticated.value" icon="mdi-logout" @click="handleLogout"></v-btn>
      <template v-slot:append>
        <v-btn icon="mdi-brightness-4" @click="toggleTheme"></v-btn>
      </template>
    </v-app-bar>

    <v-main>
      <v-container fluid class="mt-10">
        <Suspense>
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