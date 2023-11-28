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
    const response = await axios.get(`/api/pw-storage/passwords/${props.id}`)

    passwordVal.value = response.data

  } catch (error) {
    console.log('error: ', error)
  }
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <v-card title="Password">
        <v-card-text>
          {{ passwordVal }}
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text="Close" @click="handleClose"></v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>