<script setup>
import { ref, defineAsyncComponent } from 'vue'
import { useTreeStore } from '../stores/tree-store.js'

import AccessToggleDialog from './AccessToggleDialog.vue'
// const AccessToggleDialog = defineAsyncComponent(() => import('./AccessToggleDialog.vue'))
import PasswordShowDialog from './PasswordShowDialog.vue'

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

const passwordShowDialog = ref(null)
function openPasswordShowDialog() {
  passwordShowDialog.value.handleOpen()
}

</script>


<template>
  <tr>
    <td>
      <span :class="{ indent: indent }">
        <v-btn icon="mdi-eye" v-if="type == 'password'" @click="openPasswordShowDialog"></v-btn>
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

  <PasswordShowDialog ref="passwordShowDialog" :id="id" />
</template>


<style scoped>
.indent {
  margin-left: 1em;
}
</style>