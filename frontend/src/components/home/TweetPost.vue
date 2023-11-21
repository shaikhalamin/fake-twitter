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
              <span v-if="loading == false">Post</span>
              <span v-if="loading == true">
                <b-icon icon="circle-fill" animation="throb" font-scale="1.5" />
                Posting...
              </span>
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
      tweet: '',
      loading: false
    }
  },
  methods: {
    async postTweet () {
      this.loading = true
      const payload = {
        content: this.tweet
      }
      createTweet(payload).then(() => {
        this.loading = false
        this.tweet = ''
        this.$emit('onTweetCreated', 'updating tweet list ....')
      })
    }
  }
}
</script>
