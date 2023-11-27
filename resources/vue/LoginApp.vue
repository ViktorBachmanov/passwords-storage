<script setup>
import LoginDialog from './components/LoginDialog.vue'
</script>

<template>
  <v-layout>
    <v-main>
      <v-container fluid class="mt-10">
        <Suspense>
          <LoginDialog />
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