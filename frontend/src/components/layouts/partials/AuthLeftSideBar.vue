<template>
  <b-row>
    <b-col>
      <b-nav vertical>
        <b-nav-item active>
          <div class="auth-top-logo mt-3">
            <LogoSmall />
          </div>
        </b-nav-item>
        <b-nav-item class="mt-3">
          <span>
            <b-icon icon="house-door-fill" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu" @click="redirectToHome()"> Home</span>
        </b-nav-item>
        <b-nav-item class="">
          <span>
            <b-icon icon="search" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu"> Explore</span>
        </b-nav-item>
        <b-nav-item class="">
          <span>
            <b-icon icon="person" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu" @click="redirectToProfile()">
            Profile</span
          >
        </b-nav-item>
        <b-nav-item>
          <b-button
            type="button"
            variant="primary"
            class="btn btn-block signup-btn mt-2"
            >Post</b-button
          >
        </b-nav-item>
      </b-nav>
    </b-col>
  </b-row>
</template>

<script>
import LogoSmall from '@/components/layouts/LogoSmall.vue'

export default {
  name: 'AuthLeftSideBar',
  props: ['tokenUser'],
  components: {
    LogoSmall
  },
  methods: {
    redirectToProfile: function () {
      this.$router
        .push(`/profile/${this.tokenUser.user.username}`)
        .catch(() => {})
    },
    redirectToHome: function () {
      this.$router.push('/timeline').catch(() => {})
    }
  }
}
</script>
