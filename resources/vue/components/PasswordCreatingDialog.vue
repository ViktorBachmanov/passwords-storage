<script setup>
import { ref } from 'vue'

const isOpen = ref(false)

function handleOpen() {
  isOpen.value = true
}

function handleClose() {
  isOpen.value = false
}

defineExpose({
  handleOpen,
})
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <v-card>
        <v-card-text>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
          magna aliqua.
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" block @click="handleClose">Close Dialog</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>