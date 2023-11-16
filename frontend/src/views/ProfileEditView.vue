<template>
    <AuthLayout>
        <template slot-scope="{tokenUser}">
            <UserProfileEdit :tokenUser="tokenUser" />
        </template>
    </AuthLayout>
</template>

<script>
import AuthLayout from '@/components/layouts/AuthLayout.vue'
import UserProfileEdit from '@/components/profile/UserProfileEdit.vue'
// UserProfileEdit.vue
export default {
  name: 'ProfileEditView',
  components: {
    AuthLayout,
    UserProfileEdit
  }
}
</script>
