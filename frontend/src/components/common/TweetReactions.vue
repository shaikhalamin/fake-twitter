<template>
  <b-row class="mt-2">
    <b-col>
      <b-nav>
        <b-nav-item>
          <div>
            <span @click="like()">
              <b-icon
                icon="heart"
                scale="0.8"
                variant="dark"
                class="like-icon"
              ></b-icon
            ></span>
            <span class="profile-info">{{ tweet.likes.length }}</span>
          </div>
        </b-nav-item>
      </b-nav>
    </b-col>
  </b-row>
</template>

<script>
import { getLocalSession } from '@/api/local-storage'
import { likeTweet } from '@/api/services/like'

export default {
  name: 'TweetReactions',
  props: ['tweet'],
  data () {
    return {
      tokenUser: null
    }
  },
  created () {
    const session = getLocalSession()
    if (!session) {
      this.$router.push('/').catch(() => {})
    }
    this.tokenUser = session
  },
  methods: {
    async like () {
      const likePayload = {
        tweet_id: this.tweet._id
      }
      await likeTweet(likePayload)
      this.$emit('onLiked', '')
    }
  }
}
</script>
