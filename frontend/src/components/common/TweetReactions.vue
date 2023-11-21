<template>
  <b-row class="mt-2">
    <b-col>
      <b-nav>
        <b-nav-item>
          <div>
            <span @click="like()">
              <b-icon icon="heart" scale="0.8" variant="dark" class="like-icon"></b-icon></span>
            <span v-if="loading == false" class="profile-info">{{ tweet.likes.length }}</span>
            <span v-if="loading == true" class="mli-5">
              <b-icon icon="arrow-clockwise" animation="spin-pulse" font-scale="0.9"></b-icon> <span
                class="ft-13 text-dark">Reacting ...</span>
            </span>
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
      tokenUser: null,
      loading: false
    }
  },
  created () {
    const session = getLocalSession()
    if (!session) {
      this.$router.push('/').catch(() => { })
    }
    this.tokenUser = session
  },
  methods: {
    async like () {
      const likePayload = {
        tweet_id: this.tweet._id
      }
      this.loading = true
      await likeTweet(likePayload)
      this.loading = false
      this.$emit('onLiked', '')
    }
  }
}
</script>
