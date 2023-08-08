<template>
  <div class="row align-center justify-center q-mt-xl">
    <q-card class=" col-4">
      <q-card-section>
        <AuthForm />
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
import AuthForm from '../components/AuthForm.vue';

export default {
  components: {
    AuthForm
  }
};
</script>
