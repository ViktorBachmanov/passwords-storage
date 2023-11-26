import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'


export const useTreeStore = defineStore('tree-store', () => {
  const groups = ref([])
  const rootGroup = ref([])
  const groupValueLabelArr = ref([])  // for FormKit Select

  async function fetchTree() {
    try {
      const response = await axios.get('/pw-storage/tree')
      // console.log('response.data: ', response.data)
      groups.value = response.data

      groupValueLabelArr.value = response.data.map(group => {
        return {
          value: group.id,
          label: group.name,
        }
      })

      const rootGroupIndex = groups.value.findIndex(group => group.id === 1)
      rootGroup.value = groups.value.splice(rootGroupIndex, 1)[0]
    } catch (error) {
      console.log('tree-store error: ', error)
    }    
  }


  return { 
    groups, 
    rootGroup,
    groupValueLabelArr,
    fetchTree 
  }
})