<template>
  <div>
    <b-row v-for="following in followings" :key="following._id" class="mt-3">
      <b-col sm="2">
        <b-img
          rounded="circle"
          fluid
          :src="following?.follower?.avatar"
          :alt="following?.follower?.name"
          @click="viewProfile(following?.follower?.username)"
        ></b-img>
      </b-col>
      <b-col sm="10">
        <b-row>
          <b-col sm="8">
            <div
              class="ft-16 mt-2 profile-link"
              @click="viewProfile(following?.follower?.username)"
            >
              <span class="fw-500">{{ following?.follower?.name }}</span> @{{
                following?.follower?.username
              }}
            </div>
          </b-col>
          <b-col sm="4"></b-col>
        </b-row>
        <b-row>
          <b-col sm="12">
            <div class="ft-16">{{ following?.follower?.bio }}</div>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>

<script>
// import { followUser } from '@/api/services/follow'

export default {
  name: 'UserFollowers',
  props: ['followings'],
  data () {
    return {
      show: true
    }
  },
  methods: {
    async follow (followeeId) {
      const payload = {
        followee_id: followeeId
      }
      console.log('payload', payload)
      // await followUser(payload)
      // this.$router.go(0)
    },
    viewProfile: function (username) {
      this.$router.push(`/profile/${username}`).catch(() => {})
      this.$router.go(0)
    }
  },
  computed: {}
}
</script>
