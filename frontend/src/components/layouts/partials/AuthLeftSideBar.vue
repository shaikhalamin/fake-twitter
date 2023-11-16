<template>
  <b-row class="mt-3">
    <b-col>
      <b-nav vertical>
        <b-nav-item active>
          <div class="auth-top-logo" @click="redirectToHome()">
            <LogoSmall />
          </div>
        </b-nav-item>
        <b-nav-item class="mt-3" @click="redirectToHome()">
          <span>
            <b-icon icon="house-door-fill" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu"> Home</span>
        </b-nav-item>
        <b-nav-item class="">
          <span>
            <b-icon icon="search" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu"> Explore</span>
        </b-nav-item>
        <b-nav-item class="" @click="redirectToProfile()">
          <span>
            <b-icon icon="person" scale="1.2" variant="dark"></b-icon
          ></span>
          <span class="sidebar-menu"> Profile</span>
        </b-nav-item>
        <b-nav-item>
          <b-row>
            <b-col sm="2">
              <b-img
                fluid
                rounded="circle"
                :src="tokenUser?.user?.avatar"
                :alt="tokenUser?.user?.name"
              ></b-img>
            </b-col>
            <b-col sm="10">
              <div>
                <div class="ft-16 text-dark">
                  <span class="fw-500">{{ tokenUser?.user?.name }}</span> @{{
                    tokenUser?.user?.username
                  }}
                </div>
              </div>
            </b-col>
          </b-row>
        </b-nav-item>
        <b-nav-item @click="logOut()">
          <span>
            <b-icon
              icon="box-arrow-in-right"
              scale="1.2"
              variant="dark"
            ></b-icon
          ></span>
          <span class="sidebar-menu"> Logout</span>
        </b-nav-item>
      </b-nav>
    </b-col>
  </b-row>
</template>

<script>
import LogoSmall from '@/components/layouts/LogoSmall.vue'
import { authLogOut } from '@/api/services/auth'
import { removeLocalSession } from '@/api/local-storage'

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
      this.$router.go(0)
    },
    redirectToHome: function () {
      this.$router.push('/timeline').catch(() => {})
      this.$router.go(0)
    },
    logOut () {
      authLogOut()
        .then(() => {
          removeLocalSession()
          this.$router.push('/').catch(() => {})
        })
        .catch((err) => {
          console.log('err', err.message)
        })
    }
  }
}
</script>
