<script setup>
defineProps({
  label: String,
  id: Number,
})
</script>


<template>
  <tr>
    <td>{{ label }}</td>
    <td>
      <input type="checkbox">
    </td>
  </tr>

  <slot></slot>
</template>