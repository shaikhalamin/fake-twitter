<template>
  <div>
    <b-container class="mt-3" v-if="tokenUser && Object.keys(tokenUser).length > 0">
      <b-row>
        <b-col>
          <b-row>
            <b-col sm="1">
              <span>
                <b-icon icon="arrow-left" scale="1.5" variant="dark" class="text-center"></b-icon
              ></span>
            </b-col>
            <b-col sm="11">
              <h4>{{ tokenUser.user.name }}</h4>
            </b-col>
          </b-row>
          <b-row>
            <b-col sm="12">
              <h4>Modal component</h4>
            </b-col>
          </b-row>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'UserProfile',
  props: ['tokenUser'],
  data () {
    return {
      show: true
    }
  },
  created () {
    console.log(this.$route.params)
  }
}
</script>
