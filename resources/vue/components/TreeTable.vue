<script setup>
import { ref } from 'vue'

import TreeTableRow from './TreeTableRow.vue'
import GroupCreatingDialog from './GroupCreatingDialog.vue'
import PasswordCreatingDialog from './PasswordCreatingDialog.vue'


const groupCreatingDialog = ref(null)
function openGroupCreatingDialog() {
  groupCreatingDialog.value.handleOpen()
}

const passwordCreatingDialog = ref(null)
function openPasswordCreatingDialog() {
  passwordCreatingDialog.value.handleOpen()
}
</script>


<template>
  <v-table>
    <thead>
      <tr>
        <th>
          <v-btn icon="mdi-folder-plus" @click="openGroupCreatingDialog"></v-btn>
          <v-btn icon="mdi-file-settings" @click="openPasswordCreatingDialog"></v-btn>
        </th>
        <th>Access for user</th>
      </tr>
    </thead>

    <tbody>
      <TreeTableRow />
    </tbody>
  </v-table>

  <GroupCreatingDialog ref="groupCreatingDialog" />
  <PasswordCreatingDialog ref="passwordCreatingDialog" />
</template>