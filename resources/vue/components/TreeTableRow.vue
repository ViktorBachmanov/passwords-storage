<script setup>
defineProps({
  label: String,
  id: Number,
})
</script>


<template>
  <tr v-if="id !== 1">
    <td>{{ label }}</td>
    <td>
      <input type="checkbox">
    </td>
  </tr>
</template>