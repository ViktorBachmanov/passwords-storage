<script setup>
import { ref } from 'vue'
import axios from 'axios'

const isOpen = ref(false)

function handleOpen() {
  isOpen.value = true
}

function handleClose() {
  isOpen.value = false
  reset()
}

defineExpose({
  handleOpen,
})


const name = ref('')

function reset() {
  name.value = ''
}

async function handleSubmit() {
  // await axios.post('/groups', {
  //   name: name.value,
  // })
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">

    </v-dialog>
  </div>
</template>