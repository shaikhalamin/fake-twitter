<template>
  <b-container fluid="sm">
    <b-row>
      <b-col sm="6">
        <LogoBanner />
      </b-col>
      <b-col sm="6">
        <SignIn />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { getLocalSession } from '@/api/local-storage'
import LogoBanner from '@/components/auth/LogoBanner.vue'
import SignIn from '@/components/auth/SignIn.vue'

export default {
  name: 'SignInView',
  components: {
    LogoBanner,
    SignIn
  },
  created () {
    const session = this.getSession()
    if (session) {
      this.$router.push('/timeline').catch(() => {})
    }
  },
  methods: {
    getSession () {
      const userSession = getLocalSession()
      return userSession
    }
  }
}
</script>
