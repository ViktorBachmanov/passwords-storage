<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useTheme } from 'vuetify'


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


async function handleSubmit(data, node) {
  try {
    await axios.post('/pw-storage/groups', data)
    handleClose()
    treeStore.fetchTree()
  } catch (error) {
    node.setErrors(
      ['Error'],
      error.response.data.errors
    )
  }
}
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <h3>Group</h3>
      <v-sheet width="300" class="mx-auto">
        <FormKit type="form" submit-label="Create" @submit="handleSubmit" style="margin: 1em">
          <FormKit name="name" label="Name" validation="required" :input-class="{ dark: isDark }" />
        </FormKit>
      </v-sheet>
    </v-dialog>
  </div>
</template>


<style>
.dark {
  color: white;
  background-color: rgb(41, 37, 37);
}
</style>