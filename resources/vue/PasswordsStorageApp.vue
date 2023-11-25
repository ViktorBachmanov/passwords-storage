<script setup>
import axios from 'axios'

async function handleLogout() {
  await axios.post('/logout')

  window.location.reload(true)
}
</script>


<template>
  <v-card class="mx-auto" max-width="448">
    <v-layout>
      <v-app-bar color="primary" density="compact">
        <template v-slot:append>
          <v-btn icon="mdi-logout" @click="handleLogout"></v-btn>
        </template>
      </v-app-bar>

      <!-- <v-main>
        <v-container fluid>

        </v-container>
      </v-main> -->
    </v-layout>
  </v-card>
</template>