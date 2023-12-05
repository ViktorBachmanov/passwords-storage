<script setup>
import { useTheme } from 'vuetify'
import { useLocalStorage } from '@vueuse/core'

import { useAuth } from './composables/useAuth.js'
import { useTreeStore } from './stores/tree-store.js'


const theme = useTheme()

const localTheme = useLocalStorage('pws-theme', 'dark')

setGlobalTheme(localTheme.value)

function setGlobalTheme(val) {
  theme.global.name.value = val
}

function toggleTheme() {
  localTheme.value = localTheme.value === 'light' ? 'dark' : 'light';
  setGlobalTheme(localTheme.value)
}


const auth = useAuth()

const treeStore = useTreeStore()

async function handleLogout() {
  auth.logout()
  treeStore.reset()
}

</script>


<template>
  <v-layout>
    <v-app-bar color="primary" density="compact">
      <v-app-bar-title>
        Current user: {{ auth.userName }}
        <v-btn v-if="auth.isAuthenticated.value" icon="mdi-logout" @click="handleLogout" class="ml-5"></v-btn>
      </v-app-bar-title>
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
</template>



<style>
.dark {
  color: white;
  background-color: rgb(41, 37, 37);
}
</style>