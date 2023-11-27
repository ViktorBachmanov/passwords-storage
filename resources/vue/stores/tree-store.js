import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'


export const useTreeStore = defineStore('tree-store', () => {
  const groups = ref([])
  const rootGroup = ref([])
  const groupValueLabelArr = ref([])  // for FormKit Select
  const accessForUserIdNameArr = ref([])  // for FormKit Select
  const accessForUserId = ref('')

  // function setAccessForUserId(selectedUserId) {
  //   fetchTree(selectedUserId)
  // }

  async function fetchTree(/*selectedUserId = ''*/) {
    try {
      const response = await axios.get(`/pw-storage/tree?access_for_user_id=${accessForUserId.value}`)
      // console.log('response.data: ', response.data)
      groups.value = response.data.groups

      groupValueLabelArr.value = groups.value.map(group => {
        return {
          value: group.id,
          label: group.name,
        }
      })

      accessForUserIdNameArr.value = response.data.users.map(user => {
        return {
          value: user.id,
          label: user.name,
        }
      })
      // accessForUserIdNameArr.value.push({
      //   value: '-1',
      //   label: '',
      // })

      const rootGroupIndex = groups.value.findIndex(group => group.id === 1)
      rootGroup.value = groups.value.splice(rootGroupIndex, 1)[0]
    } catch (error) {
      console.log('tree-store error: ', error)
    }    
  }

  const accessableUserName = computed(() => {
    return accessForUserIdNameArr.value.find(user => user.value === accessForUserId.value)?.label
  })


  return { 
    groups, 
    rootGroup,
    groupValueLabelArr,
    accessForUserIdNameArr,
    accessForUserId,
    accessableUserName,
    fetchTree 
  }
})