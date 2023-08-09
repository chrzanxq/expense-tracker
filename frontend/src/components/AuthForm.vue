<template>
  <q-form @submit="submitForm">
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
import { Dark, Notify } from 'quasar'
import axios from 'axios'
export default {
  data() {
    return {
      email: '',
      password: '',
      registerNew: false,
    };
  },
  computed: {
    disabled(){
      return !this.email || !this.password
    },
    anchorStyle(){
      console.log(Dark.isActive)
      return Dark.isActive ? {color: 'skyblue'} : {color: 'blue'}
    }
  },  
  methods: {
    submitForm() {
      if (this.registerNew) {
        this.register();
      } else {
        this.login();
      }
    },
    async register() {
      const userData = {
        email: this.email,
        password: this.password
      };

      try {
        const response = await axios.post('http://127.0.0.1:8000/api/register', userData);
        console.log(response)

        if(response.status === 201){
          Notify.create({
            message: 'Account Created! You can now Log In',
            type:'positive'
          })

          this.registerNew = false
         
        }
        
      } catch (error) {
        console.error(error);
      }
    },

    async login() {
      console.log
    }
  }
};
</script>

<style>


a{
  cursor: pointer;
}

</style>