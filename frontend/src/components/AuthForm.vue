<template>
  <q-form @submit="submitForm">
    <q-input
      v-if="registerNew"
      class="q-pa-md"
      filled
      v-model="name"
      label="Your name"
      lazy-rules
      :rules="[val => val && val.length > 0 || 'Please type something']"
    />
    <q-input
      v-model="email"
      class="q-pa-md"
      filled
      label="Your email"
      lazy-rules
      :rules="[val => val && val.length > 0 || 'Please type something']"
    />
    <q-input
      v-model="password"
      class="q-pa-md"
      filled
      label="Password"
      type="password"
      lazy-rules
      :rules="[val => val && val.length > 0 || 'Please type something']"
    />
    <div v-if="!registerNew" class="text-center" >
      <span class="text-caption">New User? <a @click="registerNew = true" :style="anchorStyle">Sign Up</a> </span>
    </div>
    <div v-else class="text-center">
      <span class="text-caption">Already have an account? <a @click="registerNew = false" :style="anchorStyle">Sign In</a> </span>
    </div>
    <q-separator class="q-m-xl" inset />
    <q-item-section class="q-ma-md q-pa-sm">
      <q-btn
        color="amber-8"
        :label="registerNew ? 'Register' : 'Log in'"
        :disabled="disabled"
        type="submit"
      />
    </q-item-section>
  </q-form>
</template>

<script>
import { Dark } from 'quasar'
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      registerNew: false,
    };
  },
  computed: {
    disabled(){
      if(this.registerNew){
        return !this.name || !this.email || !this.password
      }
      return !this.email || !this.password
    },
    anchorStyle(){
      console.log(Dark.isActive)
      return Dark.isActive ? {color: 'skyblue'} : {color: 'blue'}
    }
  },  
  methods: {
    submitForm() {
      if (this.name) {
        this.register();
      } else {
        this.login();
      }
    },
    async register() {
      console.log('aa')
      // Send a POST request to your Symfony API endpoint for registration
      const response = await fetch('/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name: this.name,
          email: this.email,
          password: this.password
        })
      });

      console.log(response)
    },

    async login() {
      // Send login request to the server
    }
  }
};
</script>

<style>


a{
  cursor: pointer;
}

</style>