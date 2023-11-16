<template>
  <b-container
    v-if="tokenUser && Object.keys(tokenUser).length > 0"
    class="mt-3 border-left border-right"
  >
    <TweetPost />
    <UserTweets :tweets="userTweets.data" />
  </b-container>
</template>

<script>
import { getTweets } from '@/api/services/tweet'
import TweetPost from '@/components/home/TweetPost.vue'
import UserTweets from '@/components/common/UserTweets.vue'

export default {
  name: 'TimeLine',
  props: ['tokenUser'],
  components: {
    TweetPost,
    UserTweets
  },
  data () {
    return {
      userTweets: null
    }
  },
  created () {
    this.fetchTweets()
  },
  methods: {
    async fetchTweets () {
      const tweets = await getTweets()
      console.log('tweets ', tweets.data.data)
      this.userTweets = tweets.data.data
    }
  }
}
</script>
