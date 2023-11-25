<script setup>
import axios from 'axios'


async function login(credentials, node) {
  try {
    const res = await axios.post('/login', credentials)

    window.location.replace('/passwords-storage')
  } catch (error) {
    node.setErrors(
      ['Error']
    )
  }
}
</script>

<template>
  <FormKit type="form" submit-label="Login" @submit="login">
    <FormKit name="email" label="Email address" validation="required|email" />
    <FormKit type="password" name="password" label="Password" validation="required" />
  </FormKit>
</template>