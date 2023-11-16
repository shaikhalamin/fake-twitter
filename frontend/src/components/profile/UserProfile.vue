<template>
  <div>
    <b-container class="mt-3" v-if="profile && Object.keys(profile).length > 0">
      <b-row>
        <b-col>
          <b-row>
            <b-col sm="1">
              <span class="arrow-cursor" @click="redirectToTimeLine()">
                <b-icon
                  icon="arrow-left"
                  scale="1.5"
                  variant="dark"
                  class="text-center"
                ></b-icon
              ></span>
            </b-col>
            <b-col sm="11">
              <h4>{{ profile.name }}</h4>
            </b-col>
          </b-row>

          <b-row class="mb-3 mt-1">
            <b-col sm="4">
              <b-img
                rounded="circle"
                fluid
                :src="profile.avatar"
                :alt="profile.name"
              ></b-img>
            </b-col>
            <b-col sm="4"></b-col>
            <b-col
              sm="4"
              v-if="
                tokenUser &&
                Object.keys(tokenUser).length > 0 &&
                tokenUser.user._id === profile._id
              "
            >
              <b-button
                type="button"
                variant="light"
                @click="editProdile(profile.username)"
                class="btn btn-block edit-profile-btn border"
              >
                <span class="">Edit Profile</span>
              </b-button>
            </b-col>
          </b-row>

          <b-row>
            <b-col sm="12">
              <b-row>
                <b-col sm="8">
                  <div class="ft-20">{{ profile.name }}</div>
                  <div>@{{ profile.username }}</div>
                </b-col>
                <b-col
                  sm="4"
                  v-if="
                    tokenUser &&
                    Object.keys(tokenUser).length > 0 &&
                    tokenUser.user._id !== profile._id
                  "
                >
                  <b-button
                    type="button"
                    variant="light"
                    class="btn btn-block following-btn border"
                    @click="follow(profile._id)"
                  >
                    <span class="">{{ followUnfollowText }}</span>
                  </b-button>
                </b-col>
              </b-row>
              <b-row class="mt-3">
                <b-col>
                  <h4 class="ft-18">{{ profile.bio }}</h4>
                </b-col>
              </b-row>
              <b-row class="mt-2">
                <b-col>
                  <b-nav>
                    <b-nav-item>
                      <div>
                        <span>
                          <b-icon
                            icon="geo-alt"
                            scale="0.8"
                            variant="dark"
                          ></b-icon
                        ></span>
                        <span class="profile-info">{{ profile.location }}</span>
                      </div>
                    </b-nav-item>
                    <b-nav-item v-if="profile && profile?.created_at">
                      <div>
                        <span>
                          <b-icon
                            icon="calendar3"
                            scale="0.8"
                            variant="dark"
                          ></b-icon
                        ></span>
                        <span class="profile-info">
                          Joined {{ userJoined }}</span
                        >
                      </div>
                    </b-nav-item>
                  </b-nav>
                </b-col>
              </b-row>
              <b-row>
                <b-col>
                  <b-nav>
                    <b-nav-item>
                      <div class="profile-info">
                        <b>{{ following }}</b> Following
                      </div>
                    </b-nav-item>
                    <b-nav-item>
                      <div>
                        <div class="profile-info">
                          <b>{{ followers }}</b> Followers
                        </div>
                      </div>
                    </b-nav-item>
                  </b-nav>
                </b-col>
              </b-row>
              <b-row class="mt-4">
                <b-col>
                  <b-card title="Card Title" no-body>
                    <b-card-header header-tag="nav">
                      <b-nav card-header tabs>
                        <b-nav-item
                          :active="isTabActive('posts')"
                          @click="setActive('posts')"
                          ><span class="text-dark">Posts</span></b-nav-item
                        >
                        <b-nav-item
                          :active="isTabActive('following')"
                          @click="setActive('following')"
                          ><span class="text-dark">Following</span>
                        </b-nav-item>
                        <b-nav-item
                          :active="isTabActive('follower')"
                          @click="setActive('follower')"
                          ><span class="text-dark">Followers</span>
                        </b-nav-item>
                      </b-nav>
                    </b-card-header>

                    <b-card-body>
                      <div v-if="tab_active === 'posts'">
                        <UserTweets
                          @onLiked="updateTweetList"
                          :tweets="profile.tweets"
                        />
                      </div>
                      <div v-if="tab_active === 'following'">
                        <UserFollowings :followers="profile.followers" />
                      </div>
                      <div v-if="tab_active === 'follower'">
                        <UserFollowers :followings="profile.following" />
                      </div>
                    </b-card-body>
                  </b-card>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { getUserProfile } from '@/api/services/profile'
import UserTweets from '@/components/common/UserTweets.vue'
import UserFollowings from '@/components/profile/UserFollowings.vue'
import UserFollowers from '@/components/profile/UserFollowers.vue'
import { followUser } from '@/api/services/follow'
import { isFollowed } from '@/api/helpers'

export default {
  name: 'UserProfile',
  props: ['tokenUser'],
  components: {
    UserTweets,
    UserFollowings,
    UserFollowers
  },
  data () {
    return {
      profile: null,
      tab_active: 'posts'
    }
  },
  created () {
    this.getProfile()
  },
  computed: {
    userJoined () {
      const date = new Date(this.profile?.created_at).toLocaleString()
      const month = new Date(date.split(',')[0]).toLocaleString('default', {
        month: 'long'
      })
      const year = new Date(date.split(',')[0]).getFullYear()
      return `${month} ${year}`
    },
    following () {
      return this.profile.followers.length
    },
    followers () {
      return this.profile.following.length
    },
    followUnfollowText () {
      return isFollowed(this.tokenUser.following, this.profile._id)
        ? 'Unfollow'
        : 'Follow'
    }
  },
  methods: {
    async getProfile () {
      const username = this.$route.params.username
      const userProfile = await getUserProfile(username)
      this.profile = userProfile.data.data
    },
    setActive (tab) {
      this.tab_active = tab
    },
    isTabActive (tab) {
      return this.tab_active === tab
    },
    redirectToTimeLine () {
      this.$router.push('/timeline').catch(() => {})
    },
    editProdile (username) {
      this.$router.push(`/profile/edit/${username}`).catch(() => {})
    },
    async follow (followeeId) {
      const payload = {
        followee_id: followeeId
      }
      followUser(payload).then(async () => {
        this.$router.go(0)
      })
    },
    updateTweetList (message) {
      this.getProfile()
    }
  }
}
</script>
