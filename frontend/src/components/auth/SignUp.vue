<template>
  <div>
    <b-container>
      <b-container>
        <div class="py-5 mt-5 mb-5">
          <h2 class="font-size-64 font-weight-bold mb-3">
            <b>Happening now</b>
          </h2>
          <h2 class="font-weight-bold mb-2"><b>Join today.</b></h2>

          <h4 class="text-center mt-5 mb-2"><b>Create your account</b></h4>
          <div class="container py-4">
            <b-form @submit.stop.prevent="onSubmit" v-if="show">
              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input id="name" placeholder="Name" name="name" v-model="$v.form.name.$model"
                    :state="validateState('name')" aria-describedby="input-name-feedback"></b-form-input>
                  <b-form-invalid-feedback id="input-name-feedback">Name is required and must be at least 3
                    characters</b-form-invalid-feedback>
                </b-col>
              </b-row>

              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input id="username" placeholder="Username" name="username" v-model="$v.form.username.$model"
                    :state="validateState('username')" aria-describedby="input-username-feedback"></b-form-input>
                  <b-form-invalid-feedback id="input-username-feedback">Username is required and must be at least 3
                    characters</b-form-invalid-feedback>
                </b-col>
              </b-row>

              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input id="email" placeholder="Email" name="username" v-model="$v.form.email.$model"
                    :state="validateState('email')" aria-describedby="input-email-feedback"></b-form-input>
                  <b-form-invalid-feedback id="input-email-feedback">Email is required and must be type
                    email</b-form-invalid-feedback>
                </b-col>
              </b-row>

              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input id="password" placeholder="Password" name="password" v-model="$v.form.password.$model"
                    :state="validateState('password')" aria-describedby="input-password-feedback"></b-form-input>
                  <b-form-invalid-feedback id="input-password-feedback">Password is required must be at least 6
                    characters</b-form-invalid-feedback>
                </b-col>
              </b-row>

              <b-row class="py-4">
                <b-col sm="6" offset-sm="3">
                  <b-button type="submit" variant="primary" class="btn btn-block signup-btn mt-2">
                    <span v-if="loading == false">Create an account</span>
                    <span v-if="loading == true">
                      <b-icon icon="circle-fill" animation="throb" font-scale="1.2" />
                      Creating...
                    </span>
                  </b-button>
                </b-col>
              </b-row>

              <b-row class="py-3">
                <b-col sm="12">
                  <b-row class="">
                    <b-col sm="12">
                      <h6 class="mb-3 mt-3"><b>Already have an account?</b></h6>
                    </b-col>
                  </b-row>
                  <b-row class="">
                    <b-col sm="6" offset-sm="3">
                      <b-button type="button" variant="light" @click="redirectToSignIn()"
                        class="btn btn-block signin-btn mt-2 border">
                        <span>Sign in </span>
                      </b-button>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
            </b-form>
          </div>
        </div>
      </b-container>
    </b-container>
  </div>
</template>

<script>
import { createUser } from '@/api/services/user'
import { validationMixin } from 'vuelidate'
import { required, minLength, email } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  data () {
    return {
      form: {
        name: null,
        username: null,
        email: null,
        password: null
      },
      show: true,
      loading: false
    }
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(3)
      },
      username: {
        required,
        minLength: minLength(3)
      },
      email: {
        required,
        email
      },
      password: {
        required,
        minLength: minLength(6)
      }
    }
  },
  methods: {
    redirectToSignIn: function () {
      this.$router.push('/signin').catch(() => { })
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
        this.loading = true
        const result = await createUser(this.form)
        console.log('User created successfully ', result.data)
        this.loading = false
        this.redirectToSignIn()
      } catch (err) {
        this.loading = false
        const statusCode = err?.response?.status
        if (err.name === 'AxiosError' && statusCode === 422) {
          const errors = err?.response?.data?.errors
          for (const key in errors) {
            alert(errors[key][0])
          }
        } else {
          alert('Something went wrong ! Please try again')
        }
      }
    }
  }
}
</script>
