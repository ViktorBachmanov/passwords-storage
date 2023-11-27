<script setup>
import { ref, defineAsyncComponent } from 'vue'
import { useTreeStore } from '../stores/tree-store.js'

import AccessToggleDialog from './AccessToggleDialog.vue'
// const AccessToggleDialog = defineAsyncComponent(() => import('./AccessToggleDialog.vue'))

defineProps({
  label: String,
  id: Number,
  type: String,   // password | group
  access: Object,
  indent: {
    type: Boolean,
    default: false
  }
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
    <td>
      <span :class="{ indent: indent }">
        {{ label }}
      </span>
    </td>
    <td>
      <input type="checkbox" v-if="access.display" :checked="access.value" @click.prevent="openAccessToggleDialog">
    </td>
  </tr>

  <slot></slot>

  <AccessToggleDialog ref="accessToggleDialog" :currentAccess="access.value" :itemId="id" :itemType="type"
    :itemName="label" />
</template>


<style scoped>
.indent {
  margin-left: 2em;
}
</style>