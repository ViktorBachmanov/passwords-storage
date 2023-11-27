<script setup>
import { ref, defineAsyncComponent } from 'vue'
import { useTreeStore } from '../stores/tree-store.js'

import AccessToggleDialog from './AccessToggleDialog.vue'
// const AccessToggleDialog = defineAsyncComponent(() => import('./AccessToggleDialog.vue'))

defineProps({
  label: String,
  id: Number,
  type: String,   // password | group
  access: Number,
})

const treeStore = useTreeStore()

const accessToggleDialog = ref(null)
function openAccessToggleDialog() {
  if (!treeStore.accessableUserName) {
    return
  }
  accessToggleDialog.value.handleOpen()
}

</script>


<template>
  <tr>
    <td>{{ label }}</td>
    <td>
      <input type="checkbox" :checked="access" @click.prevent="openAccessToggleDialog">
    </td>
  </tr>

  <slot></slot>

  <AccessToggleDialog ref="accessToggleDialog" :currentAccess="access" :itemId="id" :itemType="type" />
</template>