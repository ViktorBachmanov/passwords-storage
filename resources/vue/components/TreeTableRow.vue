<script setup>
import { ref, defineAsyncComponent, computed } from 'vue'
import axios from 'axios'
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

import { useTreeStore } from '../stores/tree-store.js'

// import AccessToggleDialog from './AccessToggleDialog.vue'
// const AccessToggleDialog = defineAsyncComponent(() => import('./AccessToggleDialog.vue'))
import PasswordShowDialog from './PasswordShowDialog.vue'
import ArrowRight from './ArrowRight.vue'

const props = defineProps({
  label: String,
  id: Number,
  type: String,   // password | group
  access: Object,
  accessSelf: Boolean,
  indent: {
    type: Boolean,
    default: false
  }
})

const treeStore = useTreeStore()

// const accessToggleDialog = ref(null)
// function openAccessToggleDialog() {
//   if (!treeStore.accessableUserName) {
//     return
//   }
//   accessToggleDialog.value.handleOpen()
// }

const toggling = ref(false)

const $toast = useToast();

async function toggleAccess() {
  if (!treeStore.accessForUserId) {
    $toast.info("Select the user to manage access for");
    return
  }

  try {
    toggling.value = true
    await axios.patch(`/api/pw-storage/${props.type}/${props.id}`, {
      userId: treeStore.accessForUserId,
      currentAccess: props.access.value
    })
    treeStore.fetchTree()
  } catch (error) {
    console.log('toggle error: ', error)
  } finally {
    toggling.value = false
  }
}

const passwordShowDialog = ref(null)
function openPasswordShowDialog() {
  passwordShowDialog.value.handleOpen()
}

function handleSelectItem() {
  treeStore.setSelectedItem(props.type, props.id)
}

const isSelected = computed(() => {
  return props.type === treeStore.selectedItem.type && props.id === treeStore.selectedItem.id
})

const showChildren = ref(props.accessSelf)

</script>


<template>
  <tr>
    <td @click="handleSelectItem" :class="{ selected: isSelected }">
      <span :class="{ indent: indent }" style="display: flex; align-items: center;">
        <v-icon v-if="!accessSelf" icon="mdi-cancel" size="x-small" style="width: 32px; margin-right: 0.25em"></v-icon>
        <ArrowRight v-else-if="type == 'group'" :down="showChildren" @click="showChildren = !showChildren" />
        <v-btn v-else-if="type == 'password'" icon="mdi-eye" @click="openPasswordShowDialog" size="x-small"
          style="margin-right: 0.5em"></v-btn>
        {{ label }}
      </span>
    </td>
    <td>
      <!-- <input type="checkbox" v-if="access.display" :checked="access.value" @click.prevent="openAccessToggleDialog"> -->
      <input type="checkbox" v-if="access.display" :checked="access.value" @click.prevent="toggleAccess">
      <span v-if="toggling" style="margin-left: 0.5em; color: gray">wait...</span>
    </td>
  </tr>

  <slot v-if="showChildren"></slot>

  <!-- <AccessToggleDialog ref="accessToggleDialog" :currentAccess="access.value" :itemId="id" :itemType="type"
    :itemName="label" /> -->

  <PasswordShowDialog ref="passwordShowDialog" :id="id" />
</template>


<style scoped>
.indent {
  margin-left: 2em;
}

.selected {
  box-shadow: inset 0 0 4px magenta;
}
</style>