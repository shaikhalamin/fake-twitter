<template>
  <b-container fluid="sm">
    <b-row>
      <b-col sm="6">
        <LogoBanner />
      </b-col>
      <b-col sm="6">
        <SignUp />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import LogoBanner from '@/components/auth/LogoBanner.vue'
import SignUp from '@/components/auth/SignUp.vue'

export default {
  name: 'HomeView',
  components: {
    LogoBanner,
    SignUp
  }
}
</script>
