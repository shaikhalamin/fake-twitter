<template>
    <AuthLayout>
        <template slot-scope="{tokenUser}">
            <UserProfile :tokenUser="tokenUser" />
        </template>
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/layouts/AuthLayout.vue'
import UserProfile from '@/components/profile/UserProfile.vue'
export default {
  name: 'ProfileView',
  components: {
    AuthLayout,
    UserProfile
  }
}
</script>
