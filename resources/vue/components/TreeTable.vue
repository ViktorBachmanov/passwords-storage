<script setup>
import { ref, computed, watch } from 'vue'
// import axios from 'axios'

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
  <v-table>
    <thead>
      <tr>
        <th>
          <v-btn icon="mdi-folder-plus" @click="openGroupCreatingDialog"></v-btn>
          <v-btn icon="mdi-file-settings" @click="openPasswordCreatingDialog"></v-btn>
        </th>
        <th>
          Access for
          <FormKit type="select" label="User" name="user_id" v-model="treeStore.accessForUserId"
            :options="treeStore.accessForUserIdNameArr" :input-class="{ dark: isDark }" />
        </th>
      </tr>
    </thead>

    <tbody>
      <TreeTableRow v-for="group in treeStore.groups" :key="group.id" :label="group.name" :id="group.id">
        <TreeTableRow v-for="password in group.passwords" :key="password.id" :label="password.name" :id="password.id" />
      </TreeTableRow>

      <TreeTableRow v-for="password in treeStore.rootGroup.passwords" :key="password.id" :label="password.name"
        :id="password.id" />
    </tbody>
  </v-table>

  <GroupCreatingDialog ref="groupCreatingDialog" />
  <PasswordCreatingDialog ref="passwordCreatingDialog" />
</template>