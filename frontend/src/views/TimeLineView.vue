<template>
    <AuthLayout>
        <template slot-scope="{tokenUser}">
            <TimeLine :tokenUser="tokenUser" />
        </template>
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/layouts/AuthLayout.vue'
import TimeLine from '@/components/home/TimeLine.vue'
export default {
  name: 'TimeLineView',
  components: {
    AuthLayout,
    TimeLine
  }
}
</script>
