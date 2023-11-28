<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useTheme } from 'vuetify'

import { useTreeStore } from '../stores/tree-store.js'


const theme = useTheme()
const isDark = computed(() => theme.global.current.value.dark)

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

const treeStore = useTreeStore()

async function handleSubmit(data, node) {
  try {
    await axios.post('/api/pw-storage/groups', data)
    handleClose()
    treeStore.fetchTree()
  } catch (error) {
    node.setErrors(
      ['Error'],
      {
        name: error.response.data.message
      }
    )
  }
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <h3>Group</h3>
      <v-sheet width="300" class="mx-auto">
        <FormKit type="form" :actions="false" #default="{ disabled }" @submit="handleSubmit" style="margin: 1em">
          <FormKit name="name" label="Name" validation="required" :input-class="{ dark: isDark }" />
          <v-card-actions>
            <FormKit type="submit" label="Create" :disabled="disabled" />
            <FormKit type="button" label="Cancel" @click="handleClose" style="background: rgb(60, 104, 127)" />
          </v-card-actions>
        </FormKit>
      </v-sheet>
    </v-dialog>
  </div>
</template>

