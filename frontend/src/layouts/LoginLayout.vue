<template>
  <q-layout>
    <q-page-container>
      <DarkModeToggle/>
      <router-view />
    </q-page-container>
  </q-layout>
</template>
<script>
import { defineComponent, ref } from 'vue'
import DarkModeToggle from '../components/DarkmodeToggle.vue'



export default defineComponent({
  name: 'LoginLayout',

  components: {
    DarkModeToggle
  },

  setup () {
    return {

    }
  }
})
</script>
