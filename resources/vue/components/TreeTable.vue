<script setup>
import { ref, computed, watch } from 'vue'

import TreeTableRow from './TreeTableRow.vue'
import GroupCreatingDialog from './GroupCreatingDialog.vue'
import PasswordCreatingDialog from './PasswordCreatingDialog.vue'
import { useTreeStore } from '../stores/tree-store.js'
import { useTheme } from 'vuetify'


const theme = useTheme()
const isDark = computed(() => theme.global.current.value.dark)


const treeStore = useTreeStore()
await treeStore.fetchTree();


watch(() => treeStore.accessForUserId, () => {
  treeStore.fetchTree();
})

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
  <v-table class="mx-auto" style="max-width: 800px;">
    <thead>
      <tr>
        <th>
          <v-btn icon="mdi-folder-plus" @click="openGroupCreatingDialog" class="mr-2"></v-btn>
          <v-btn icon="mdi-file-settings" @click="openPasswordCreatingDialog"></v-btn>
        </th>
        <th style="text-align: center;">
          <div>
            <h3 style="margin: 0.5em 0;">Access for</h3>
            <v-select label="User" :items="treeStore.accessForUserIdNameArr" item-title="label" item-value="value"
              v-model="treeStore.accessForUserId" variant="outlined"></v-select>
          </div>
        </th>
      </tr>
    </thead>

    <tbody>
      <TreeTableRow v-for="group in treeStore.groups" :key="group.id" :label="group.name" :id="group.id" type="groups"
        :access="group.access" :accessSelf="group.accessSelf">
        <TreeTableRow v-for="password in group.passwords" :key="password.id" :label="password.name" :id="password.id"
          type="passwords" :access="password.access" :accessSelf="password.accessSelf" :indent="true" />
      </TreeTableRow>

      <TreeTableRow v-for="password in treeStore.rootGroup.passwords" :key="password.id" :label="password.name"
        :id="password.id" type="passwords" :access="password.access" :accessSelf="password.accessSelf" />
    </tbody>
  </v-table>

  <GroupCreatingDialog ref="groupCreatingDialog" />
  <PasswordCreatingDialog ref="passwordCreatingDialog" />
</template>