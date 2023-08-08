<template>
  <q-toggle
        v-model="darkMode"
        checked-icon="mdi-moon-waning-crescent"
        color="amber-9"
        @click="changeTheme"
        size="xl"
        unchecked-icon="mdi-white-balance-sunny"
        keep-color
      />
</template>

<script>

import { defineComponent, ref } from 'vue'
import {useQuasar} from 'quasar'

export default {
  name: 'DarkModeToggle',
  setup () {
    const $q = useQuasar()

    const darkMode = ref(false)

    function changeTheme(){
      darkMode.value ? $q.dark.set(true) : $q.dark.set(false)
    }

    return {
      darkMode,
      changeTheme
      
    }
  }
}
</script>