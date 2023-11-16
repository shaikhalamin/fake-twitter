<template>
  <b-container>
    <b-row>
      <b-col sm="3">
        <AuthLeftSideBar :tokenUser="tokenUser" />
      </b-col>
      <b-col sm="6">
        <slot :tokenUser="tokenUser"></slot>
      </b-col>
      <b-col sm="3">
        <AuthRightSideBar :tokenUser="tokenUser" />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { getLocalSession } from '@/api/local-storage'
import { followingFollowerList } from '@/api/services/follow'
import AuthLeftSideBar from '@/components/layouts/partials/AuthLeftSideBar.vue'
import AuthRightSideBar from '@/components/layouts/partials/AuthRightSideBar.vue'

export default {
  name: 'AuthLayout',
  components: {
    AuthLeftSideBar,
    AuthRightSideBar
  },
  data () {
    return {
      tokenUser: null
    }
  },
  created () {
    const session = this.getSession()
    if (!session) {
      this.$router.push('/').catch(() => {})
    }
    this.tokenUser = session
    this.fetchFollowingFollowers()
  },
  methods: {
    getSession () {
      const userSession = getLocalSession()
      return userSession
    },
    async fetchFollowingFollowers () {
      const list = await followingFollowerList()
      const followingFollowers = list.data.data
      const updatedTokenUser = Object.assign(
        this.tokenUser,
        followingFollowers
      )
      this.tokenUser = updatedTokenUser
    }
  },
  errorCaptured (err, vm, info) {
    this.error = `${err.stack}\n\nfound in ${info} of component`
    return false
  }
}
</script>
