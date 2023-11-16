<template>
  <b-row>
    <b-col>
      <b-row class="mt-3">
        <b-col>
          <b-input-group>
            <template #prepend>
              <b-input-group-text class="">
                <span>
                  <b-icon icon="search" scale="0.8" variant="info"></b-icon
                ></span>
              </b-input-group-text>
            </template>
            <b-form-input
              v-model="searchTerm"
              @input="handleSearch"
              placeholder="Search by username or email ..."
            ></b-form-input>
          </b-input-group>
        </b-col>
      </b-row>
      <b-row class="mt-3">
        <b-col>
          <h3 class="mt-2 mb-3 ft-20 fw-500">Who to follow</h3>
          <div v-if="users?.data?.length > 0">
            <b-row
              v-for="user in users.data"
              :key="user._id"
              class="mt-3 border-bottom"
            >
              <b-col sm="2">
                <b-img
                  fluid
                  rounded="circle"
                  :src="user.avatar"
                  :alt="user.name"
                  @click="viewProfile(user.username)"
                ></b-img>
              </b-col>
              <b-col sm="10" class="mb-2">
                <b-row>
                  <b-col
                    sm="6"
                    class="profile-link"
                    @click="viewProfile(user.username)"
                  >
                    <div class="ft-16">
                      <span class="fw-500">{{ user.name }}</span> @{{
                        user.username
                      }}
                    </div>
                  </b-col>
                  <b-col sm="6">
                    <b-button
                      type="button"
                      variant="light"
                      @click="follow(user._id)"
                      class="btn btn-block following-btn border"
                    >
                      <span class="">{{ followUnfollowText(user._id) }}</span>
                    </b-button>
                  </b-col>
                </b-row>
              </b-col>
            </b-row>
          </div>
        </b-col>
      </b-row>
    </b-col>
  </b-row>
</template>

<script>
import _debounce from 'lodash/debounce'
import { followUser } from '@/api/services/follow'
import { getUsers, searchUsers } from '@/api/services/user'
import { isFollowed } from '@/api/helpers'

export default {
  name: 'AuthRightSideBar',
  props: ['tokenUser'],
  components: {},
  data () {
    return {
      users: null,
      searchTerm: ''
    }
  },
  created () {
    this.getUsersList()
  },
  methods: {
    async getUsersList () {
      const users = await getUsers()
      this.users = users.data.data
    },
    async follow (followeeId) {
      const payload = {
        followee_id: followeeId
      }
      await followUser(payload)
      await this.getUsersList()
      this.$router.go(0)
    },
    viewProfile: function (username) {
      this.$router.push(`/profile/${username}`).catch(() => {})
      this.$router.go(0)
    },
    debouncedSearch: _debounce(async function () {
      console.log('search term', this.searchTerm)
      if (this.searchTerm.length > 0) {
        const searchList = await searchUsers(this.searchTerm)
        this.users = searchList.data.data
      } else {
        this.getUsersList()
      }
    }, 400),
    handleSearch () {
      this.debouncedSearch()
    },
    followUnfollowText (searchedUserId) {
      return isFollowed(this.tokenUser.following, searchedUserId)
        ? 'Unfollow'
        : 'Follow'
    }
  }
}
</script>
