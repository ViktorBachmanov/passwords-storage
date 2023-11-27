<script setup>
import { ref } from 'vue'
import axios from 'axios'

const props = defineProps({
  id: Number
})


const isOpen = ref(false)

function handleOpen() {
  fetchPasswordValue()
  isOpen.value = true
}

function handleClose() {
  isOpen.value = false
}

defineExpose({
  handleOpen,
})

const passwordVal = ref('')


async function fetchPasswordValue() {
  try {
    const response = await axios.get(`/pw-storage/passwords/${props.id}`)

    passwordVal.value = response.data

  } catch (error) {
    console.log('error: ', error)
  }
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <h3>Password</h3>
      <v-sheet width="300" class="mx-auto">
        {{ passwordVal }}
      </v-sheet>

      <v-btn text="Close" @click="handleClose"></v-btn>
    </v-dialog>
  </div>
</template>