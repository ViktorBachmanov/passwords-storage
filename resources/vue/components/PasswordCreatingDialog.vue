<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useTreeStore } from '../stores/tree-store.js'
import { useTheme } from 'vuetify'


const theme = useTheme()
const isDark = computed(() => theme.global.current.value.dark)

const treeStore = useTreeStore()

const isOpen = ref(false)

const value = ref('')

function handleOpen() {
  isOpen.value = true
  reset();
}

function handleClose() {
  isOpen.value = false
}

function reset() {
  value.value = ''
}

defineExpose({
  handleOpen,
})


function handleGenerate() {
  const length = 8
  const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#$%&*"
  let val = ""
  for (let i = 0, n = charset.length; i < length; ++i) {
    val += charset.charAt(Math.floor(Math.random() * n));
  }

  value.value = val;
}

async function handleSubmit(data, node) {
  try {
    await axios.post('/api/pw-storage/passwords', data)
    handleClose()
    treeStore.fetchTree()
  } catch (error) {
    node.setErrors(
      ['Error'],
      error.response.data.errors
    )
  }
}

const selectedGroupId = computed({
  get() {
    return treeStore.selectedItem.type == 'group'
      ? treeStore.selectedItem.id
      : ''
  },
  set(val) {
    if (treeStore.selectedItem.type == 'group') {
      treeStore.setSelectedItem('group', val)
    }
  }
})
</script>


<template>
  <div class="text-center">
    <v-dialog v-model="isOpen" width="auto">
      <h3>Password</h3>
      <v-sheet width="300" class="mx-auto">
        <FormKit type="form" submit-label="Save" @submit="handleSubmit" style="margin: 1em">
          <FormKit type="select" label="Group" v-model="selectedGroupId" name="group_id"
            :options="treeStore.groupValueLabelArr" :input-class="{ dark: isDark }" />
          <FormKit name="name" label="Name" validation="required" :input-class="{ dark: isDark }" />
          <FormKit name="value" label="Value" v-model="value" validation="required" :input-class="{ dark: isDark }" />
          <FormKit type="button" label="Generate" @click="handleGenerate" />
          <FormKit type="button" label="Cancel" @click="handleClose" />
        </FormKit>
      </v-sheet>
    </v-dialog>
  </div>
</template>