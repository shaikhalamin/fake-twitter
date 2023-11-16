<template>
  <div>
    <b-row
      v-for="tweet in tweets"
      :key="tweet._id"
      class="py-4 border mt-1 mb-1"
    >
      <b-col sm="2">
        <b-img
          rounded="circle"
          fluid
          :src="tweet?.user?.avatar"
          :alt="tweet?.user?.name"
        ></b-img>
      </b-col>
      <b-col sm="10">
        <div>
          <div class="ft-16">
            <span class="fw-500">{{ tweet?.user?.name }}</span> @{{
              tweet?.user?.username
            }}
            {{ tweetCreated(tweet.created_at) }}
          </div>
          <div class="ft-16">{{ tweet.content }}</div>
        </div>
        <TweetReactions @onLiked="updateTweetList" :tweet="tweet" />
      </b-col>
    </b-row>
  </div>
</template>
<script>
import TweetReactions from '@/components/common/TweetReactions.vue'

export default {
  name: 'UserTweets',
  props: ['tweets'],
  components: {
    TweetReactions
  },
  data () {
    return {
      show: true
    }
  },
  methods: {
    updateTweetList () {
      this.$emit('onLiked', '')
    },
    tweetCreated (createdAt) {
      const date = new Date(createdAt).toLocaleString()
      const month = new Date(date.split(',')[0]).toLocaleString('default', {
        month: 'short'
      })
      const year = new Date(date.split(',')[0]).getFullYear()
      const dateNumber = new Date(date.split(',')[0]).getDate()
      return `${month} ${dateNumber} ${year}`
    }
  }
}
</script>
