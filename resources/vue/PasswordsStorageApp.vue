<script setup>
import axios from 'axios'
import { useTheme } from 'vuetify'


import TreeTable from './components/TreeTable.vue'


const theme = useTheme()

function toggleTheme() {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
}


async function handleLogout() {
  await axios.post('/logout')

  window.location.reload(true)
}
</script>


<template>
  <!-- <v-card class="mx-auto" max-width="448"> -->
  <v-layout>
    <v-app-bar color="primary" density="compact">
      <template v-slot:append>
        <v-btn icon="mdi-brightness-4" @click="toggleTheme"></v-btn>
        <v-btn icon="mdi-logout" @click="handleLogout"></v-btn>
      </template>
    </v-app-bar>

    <v-main>
      <v-container fluid class="mt-10">
        <TreeTable />
      </v-container>
    </v-main>

  </v-layout>
  <!-- </v-card> -->
</template>