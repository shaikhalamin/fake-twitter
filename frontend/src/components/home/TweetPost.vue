<template>
  <b-container class="mb-5 border-bottom">
    <b-row>
      <b-col>
        <b-form-textarea
          id="tweets"
          v-model="tweet"
          placeholder="Whats happening..."
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-col>
    </b-row>
    <b-row class="py-3">
      <b-col sm="12">
        <b-row class="">
          <b-col sm="6" offset-sm="3">
            <b-button
              type="button"
              :disabled="!tweet.length"
              variant="primary"
              @click="postTweet()"
              class="btn btn-block tweet-btn mt-2 border"
            >
              <span>Post</span>
            </b-button>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { createTweet } from '@/api/services/tweet'
export default {
  name: 'TweetPost',
  data () {
    return {
      tweet: ''
    }
  },
  methods: {
    async postTweet () {
      const payload = {
        content: this.tweet
      }
      createTweet(payload).then(() => {
        this.tweet = ''
        this.$emit('onTweetCreated', 'updating tweet list ....')
      })
    }
  }
}
</script>
