import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'


export const useTreeStore = defineStore('tree-store', () => {
  const groups = ref([])
  const rootGroup = ref([])

  async function fetchTree() {
    try {
      const response = await axios.get('/pw-storage/tree')
      // console.log('response.data: ', response.data)
      groups.value = response.data

      const rootGroupIndex = groups.value.findIndex(group => group.id === 1)
      rootGroup.value = groups.value.splice(rootGroupIndex, 1)[0]
    } catch (error) {
      console.log('tree-store error: ', error)
    }    
  }


  return { 
    groups, 
    rootGroup,
    fetchTree 
  }
})