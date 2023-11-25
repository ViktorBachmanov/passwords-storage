<script setup>
import TreeTableRow from './TreeTableRow.vue'
</script>


<template>
  <v-table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Access for user</th>
      </tr>
    </thead>

    <tbody>
      <TreeTableRow />
    </tbody>
  </v-table>
</template>