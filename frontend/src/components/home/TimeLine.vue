<template>
  <div>
    <b-container class="mt-3 border-left border-right">
      <TweetPost @onTweetCreated="updateTweetList" />
      <b-container v-if="loading" class="py-4">
        <b-col class="py-3">
          <h6 class="text-center"><b-icon icon="circle-fill" animation="throb" font-scale="1.2"></b-icon> Fetching
            tweets...
          </h6>
        </b-col>
      </b-container>
      <UserTweets v-if="userTweets && userTweets.data.length > 0" @onLiked="updateTweetList" :tweets="userTweets.data" />
    </b-container>
  </div>
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
      userTweets: null,
      loading: false
    }
  },
  created () {
    this.fetchTweets(true)
  },
  methods: {
    async fetchTweets (shouldFetch) {
      this.loading = shouldFetch
      const tweets = await getTweets()
      this.loading = false
      this.userTweets = tweets.data.data
    },
    async updateTweetList (message) {
      console.log(message)
      await this.fetchTweets(false)
    }
  }
}
</script>
