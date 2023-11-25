<script setup>
import { ref } from 'vue'
import axios from 'axios'

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

const name = ref('')
const value = ref('')

function handleGenerate() {
  const length = 8
  const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#$%&*"
  let val = ""
  for (let i = 0, n = charset.length; i < length; ++i) {
    val += charset.charAt(Math.floor(Math.random() * n));
  }

  value.value = val;
}

async function handleSubmit() {
  await axios.post('/api/passwords', {
    name: name.value,
    value: value.value
  })
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <!-- <v-card> -->
      <h3>Password</h3>
      <v-sheet width="300" class="mx-auto">
        <v-form @submit.prevent="handleSubmit">
          <v-text-field v-model="name" label="Name"></v-text-field>
          <v-text-field v-model="value" label="Value"></v-text-field>
          <v-btn block class="mt-2" @click="handleGenerate">Generate</v-btn>
          <v-btn type="submit" class="mt-2">Create</v-btn>
          <v-btn class="mt-2" @click="handleClose">Cancel</v-btn>
        </v-form>
        <!-- </v-card> -->
      </v-sheet>
    </v-dialog>
  </div>
</template>