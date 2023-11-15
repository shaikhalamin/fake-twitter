<template>
  <div>
    <b-container v-if="tokenUser && Object.keys(tokenUser).length > 0">
      <h1>Time line page</h1>
      <h6>{{ tokenUser.user.email }}</h6>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'TimeLine',
  props: ['tokenUser'],
  data () {
    return {
      show: true
    }
  },
  created () {}
}
</script>
