<template>
    <q-layout view="hHh lpR fFf">
  
      <q-header elevated class="bg-amber-3 text-white">
        <q-toolbar>
          <q-toolbar-title>
            <q-tabs
                v-model="tab"
                class="text-green"
            >
                <q-tab name="mails" icon="mdi-chart-line-variant" label="Statistics" />
                <q-tab name="alarms" icon="mdi-target" label="My Targets" />
                <q-tab name="movies" icon="mdi-cash-multiple" label="Tracker" />
            </q-tabs>
          </q-toolbar-title>
          <DarkModeToggle/>
        </q-toolbar>
      </q-header>
      <q-page-container>
        <router-view />
      </q-page-container>
  
    </q-layout>
  </template>
  <script>
  import { defineComponent, ref } from 'vue'
  import DarkModeToggle from '../components/DarkmodeToggle.vue'

  
  export default defineComponent({
    name: 'MainLayout',
  
    components: {
      DarkModeToggle
    },
  
    setup () {
      return {

  
      }
    }
  })
  </script>
  