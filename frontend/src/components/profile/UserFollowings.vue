<template>
  <div>
    <b-row v-for="follower in followers" :key="follower._id" class="mt-3">
      <b-col sm="2">
        <b-img
          rounded="circle"
          fluid
          :src="follower?.following?.avatar"
          :alt="follower?.following?.name"
          @click="viewProfile(follower?.following?.username)"
        ></b-img>
      </b-col>
      <b-col sm="10">
        <b-row>
          <b-col sm="8">
            <div class="ft-16 mt-2 profile-link" @click="viewProfile(follower?.following?.username)">
              <span class="fw-500">{{ follower?.following?.name }}</span> @{{
                follower?.following?.username
              }}
            </div>
          </b-col>
          <b-col sm="4">
            <b-button
              type="button"
              variant="light"
              @click="followUnfollow(follower?.following?._id)"
              class="btn btn-block following-btn border"
            >
              <span class="">Following</span>
            </b-button>
          </b-col>
        </b-row>
        <b-row>
          <b-col sm="12">
            <div class="ft-16">{{ follower?.following?.bio }}</div>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'UserFollowings',
  props: ['followers'],
  data () {
    return {
      show: true
    }
  },
  methods: {
    followUnfollow (followeeId) {
      console.log(followeeId)
    },
    viewProfile: function (username) {
      this.$router.push(`/profile/${username}`).catch(() => {})
      this.$router.go(0)
    }
  },
  computed: {}
}
</script>
