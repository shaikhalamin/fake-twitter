<template>
  <div>
    <b-container>
      <b-container v-if="form && Object.values(form).length > 0">
        <div class="py-5 mb-5">
          <h3 class="mb-2">
            <b>Edit Profile</b>
            <span v-if="loading" class=" mli-5 text-center ft-14">
              <b-icon icon="arrow-clockwise" animation="spin-pulse" font-scale="1.2"></b-icon>
              Fetching...
            </span>
          </h3>
          <b-form @submit.stop.prevent="onSubmit">
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-input id="email" placeholder="Email" v-model="email" :disabled="isDisabled"></b-form-input>
              </b-col>
            </b-row>
            <b-row class="py-2">
              <b-col sm="12">
                <b-form-input id="username" placeholder="Username" v-model="username"
                  :disabled="isDisabled"></b-form-input>
              </b-col>
            </b-row>
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
                <b-form-input id="location" placeholder="Location" name="location" v-model="$v.form.location.$model"
                  :state="validateState('location')" aria-describedby="input-location-feedback"></b-form-input>
              </b-col>
            </b-row>
            <b-row class="py-2">
              <b-col sm="6">
                <b-form-file @change="selectFile($event)" class="mt-3" plain></b-form-file>
              </b-col>
              <b-col sm="6" class="ml-2 mr-2">
                <h6 v-if="uploadingImage == true" class="text-center ft-14 py-3">
                  <b-icon icon="arrow-clockwise" animation="spin-pulse" font-scale="1.2"></b-icon>
                  Uploading profiles...
                </h6>
                <b-img v-if="uploadingImage == false && this.form.image_id && this.form.image_id.length > 0"
                  rounded="=thumbnail" fluid :src="this.form.avatar" :alt="this.form.image_id" class="border"></b-img>
              </b-col>
            </b-row>
            <b-row class="py-3">
              <b-col sm="6" offset-sm="3">
                <b-button type="submit" :disabled="loading == true" variant="primary"
                  class="btn btn-block signup-btn mt-2">
                  <span v-if="isSubmitting == false">Update</span>
                  <span v-if="isSubmitting == true">
                    <b-icon icon="circle-fill" animation="throb" font-scale="1.2" />
                    Updating ...
                  </span>
                </b-button>
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
import { preparefileUpload, uploadFile } from '@/api/services/file'

export default {
  name: 'UserProfile',
  props: ['tokenUser'],
  mixins: [validationMixin],
  data () {
    return {
      userId: null,
      username: null,
      email: null,
      image_id: null,
      form: {
        name: null,
        bio: null,
        location: null,
        avatar: null,
        image_id: null
      },
      loading: false,
      isSubmitting: false,
      uploadingImage: false,
      isDisabled: true
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
    async selectFile (event) {
      const file = event.target.files[0]
      const payload = preparefileUpload(file)
      this.uploadingImage = true
      const upload = await uploadFile(payload)
      this.uploadingImage = false
      this.form.avatar = upload.data.image_url
      this.form.image_id = upload.data.public_id
    },
    async getProfile () {
      const username = this.$route.params.username
      this.loading = true
      const userProfile = await getUserProfile(username)
      const profile = userProfile.data.data
      this.loading = false
      this.userId = profile._id
      this.username = profile.username
      this.image_id = profile.image_id
      this.email = profile.email
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
        let payload = {
          name: this.form.name,
          bio: this.form.bio,
          location: this.form.location
        }
        if (this.form.avatar && this.form.avatar.length > 0 && this.form.image_id && this.form.image_id.length) {
          payload = {
            ...payload,
            avatar: this.form.avatar,
            image_id: this.form.image_id
          }
        }

        const updatePayload = prepareFormData(payload)
        this.isSubmitting = true
        const updatedUser = await updateUser(this.userId, updatePayload)
        this.isSubmitting = false
        const user = updatedUser.data.data
        const latestUpdateUser = {
          user: user
        }
        updateLocalSession(latestUpdateUser)
        this.$router.push(`/profile/${user.username}`).catch(() => { })
        this.$router.go(0)
      } catch (err) {
        console.log('user update error ', err)
      }
    }
  }
}
</script>
