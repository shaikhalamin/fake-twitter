<template>
  <div>
    <b-container>
      <b-container>
        <div class="py-5 mb-5">
          <h2 class="font-weight-bold mb-2"><b>Edit Profile</b></h2>
          <b-form @submit.stop.prevent="onSubmit">
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-input
                  id="name"
                  placeholder="Name"
                  name="name"
                  v-model="$v.form.name.$model"
                  :state="validateState('name')"
                  aria-describedby="input-name-feedback"
                ></b-form-input>
              </b-col>
            </b-row>
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-input
                  id="bio"
                  placeholder="Bio"
                  name="bio"
                  v-model="$v.form.bio.$model"
                  :state="validateState('bio')"
                  aria-describedby="input-bio-feedback"
                ></b-form-input>
              </b-col>
            </b-row>
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-input
                  id="location"
                  placeholder="Location"
                  name="location"
                  v-model="$v.form.location.$model"
                  :state="validateState('location')"
                  aria-describedby="input-location-feedback"
                ></b-form-input>
              </b-col>
            </b-row>
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-file
                  @change="selectFile($event)"
                  class="mt-3"
                  plain
                ></b-form-file>
              </b-col>
            </b-row>
            <b-row class="py-4">
              <b-col sm="6" offset-sm="3">
                <b-button
                  type="submit"
                  variant="primary"
                  class="btn btn-block signup-btn mt-2"
                  >Update profile</b-button
                >
              </b-col>
            </b-row>
          </b-form>
        </div>
      </b-container>
    </b-container>
  </div>
</template>

<script>
import { getUserProfile } from '@/api/services/profile'
import { updateLocalSession } from '@/api/local-storage'
import { updateUser, prepareFormData } from '@/api/services/user'
import { validationMixin } from 'vuelidate'
import { required, minLength, requiredUnless } from 'vuelidate/lib/validators'

export default {
  name: 'UserProfile',
  props: ['tokenUser'],
  mixins: [validationMixin],
  data () {
    return {
      userId: null,
      username: null,
      form: {
        name: null,
        bio: null,
        location: null
      },
      avatar: null
    }
  },
  created () {
    this.getProfile()
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(3)
      },
      bio: {
        requiredIf: requiredUnless(function () {
          return this.form.bio !== null || this.form.bio !== ''
        })
      },
      location: {
        requiredIf: requiredUnless(function () {
          return this.form.location !== null || this.form.location !== ''
        })
      }
    }
  },
  methods: {
    selectFile (event) {
      const file = event.target.files[0]
      this.avatar = file
    },
    async getProfile () {
      const username = this.$route.params.username
      const userProfile = await getUserProfile(username)
      const profile = userProfile.data.data
      this.userId = profile._id
      this.form = {
        name: profile.name,
        bio: profile.bio,
        location: profile.location
      }
    },
    validateState (name) {
      const { $dirty, $error } = this.$v.form[name]
      return $dirty ? !$error : null
    },
    async onSubmit () {
      this.$v.form.$touch()
      if (this.$v.form.$anyError) {
        return
      }
      try {
        const payload = {
          name: this.form.name,
          bio: this.form.bio,
          location: this.form.location,
          avatar: this.avatar
        }
        const updatePayload = prepareFormData(payload)
        const updatedUser = await updateUser(this.userId, updatePayload)
        const user = updatedUser.data.data
        const latestUpdateUser = {
          user: user
        }
        updateLocalSession(latestUpdateUser)
        this.$router.push(`/profile/${user.username}`).catch(() => {})
        this.$router.go(0)
      } catch (err) {
        console.log('user update error ', err)
      }
    }
  }
}
</script>
