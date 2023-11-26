import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'


export const useTreeStore = defineStore('tree-store', () => {
  const groups = ref([])
  const passwords = ref([])

  async function fetchTree() {
    try {
      const response = await axios.get('/pw-storage/tree')
      // console.log(response)
      groups.value = response.data.groups
      passwords.value = response.data.passwords
    } catch (error) {
      console.log('tree-store error: ', error)
    }    
  }


  return { 
    groups, 
    passwords,
    fetchTree 
  }
})