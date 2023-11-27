<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useTreeStore } from '../stores/tree-store.js'
import { useTheme } from 'vuetify'

const props = defineProps({
  currentAccess: Number,
  itemType: String, // password | group
  itemId: Number,
})


const theme = useTheme()
const isDark = computed(() => theme.global.current.value.dark)

const treeStore = useTreeStore()


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

const value = ref('')


async function handleSubmit() {
  try {
    await axios.patch(`/pw-storage/toggle-access`, {
      itemType: props.itemType,
      itemId: props.itemId,
      userId: treeStore.accessForUserId,
      currentAccess: props.currentAccess
    })
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
      <h3>Access</h3>
      <v-sheet width="300" class="mx-auto">
        {{ currentAccess ? 'Запретить' : 'Разрешить' }} доступ к {{ itemType == 'password' ? 'паролю' : 'группе' }}
        пользователю {{ treeStore.accessableUserName }}
      </v-sheet>

      <v-btn text="Ok" @click="handleSubmit"></v-btn>

      <v-btn text="Cancel" @click="handleClose"></v-btn>
    </v-dialog>
  </div>
</template>