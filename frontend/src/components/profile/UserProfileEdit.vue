<template>
    <div>
        <b-container>
            <b-container>
                <div class="py-5 mb-5">
                    <h2 class="font-weight-bold mb-2"><b>Edit Profile</b></h2>
                    <b-form @submit.stop.prevent="onSubmit">
                        <b-row class="py-2">
                            <b-col sm="12">
                                <b-form-input id="name" placeholder="Name" name="name" v-model="$v.form.name.$model"
                                    :state="validateState('name')" aria-describedby="input-name-feedback"></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row class="py-2">
                            <b-col sm="12">
                                <b-form-input id="bio" placeholder="Bio" name="bio" v-model="$v.form.bio.$model"
                                    :state="validateState('bio')" aria-describedby="input-bio-feedback"></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row class="py-2">
                            <b-col sm="12">
                                <b-form-input id="location" placeholder="Location" name="location"
                                    v-model="$v.form.location.$model" :state="validateState('location')"
                                    aria-describedby="input-location-feedback"></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row class="py-2">
                            <b-col sm="12">
                                <b-form-file v-model="$v.form.avatar.$model" :state="validateState('avatar')" class="mt-3"
                                    plain></b-form-file>
                            </b-col>
                        </b-row>
                        <b-row class="py-4">
                            <b-col sm="6" offset-sm="3">
                                <b-button type="submit" variant="primary" class="btn btn-block signup-btn mt-2">Update
                                    profile</b-button>
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
import { prepareFormData } from '@/api/services/user'
import { validationMixin } from 'vuelidate'
import { required, minLength, requiredUnless } from 'vuelidate/lib/validators'

export default {
  name: 'UserProfile',
  props: ['tokenUser'],
  mixins: [validationMixin],
  data () {
    return {
      form: {
        name: null,
        bio: null,
        location: null,
        avatar: null
      },
      show: true
    }
  },
  created () {
    this.getProfile()
  },
  validations: {
    form: {
      //   name: {
      //     required,
      //     minLength: minLength(3)
      //   },
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
      },
      avatar: {
        requiredIf: requiredUnless(function () {
          return this.form.avatar !== null || this.form.avatar !== ''
        })
      }
    }
  },
  methods: {
    async getProfile () {
      const username = this.$route.params.username
      const userProfile = await getUserProfile(username)
      const profile = userProfile.data.data
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
        console.log('form payload ', this.form)
        const updatePayload = prepareFormData(this.form)
        console.log('updatePayload', updatePayload)
        // const update = await updateUser(updatePayload)
        // console.log('update', update)
        // this.$router
        //   .push(`/profile/${username}`)
        //   .catch(() => { })
      } catch (err) {
        console.log('user update error ', err)
        // this.$router.go(0)
      }
    }
  }
}
</script>
