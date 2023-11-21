<template>
  <div>
    <b-container>
      <b-container>
        <div class="py-5 mt-5 mb-5">
          <h2 class="text-center mt-5 mb-2"><b>Signin</b></h2>
          <div class="container py-4">
            <b-form @submit.stop.prevent="onSubmit" v-if="show">
              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input
                    id="email"
                    placeholder="Email"
                    name="username"
                    v-model="$v.form.email.$model"
                    :state="validateState('email')"
                    aria-describedby="input-email-feedback"
                  ></b-form-input>
                  <b-form-invalid-feedback id="input-email-feedback"
                    >Email is required and must be type
                    email</b-form-invalid-feedback
                  >
                </b-col>
              </b-row>
              <b-row class="py-2">
                <b-col sm="12">
                  <b-form-input
                    id="password"
                    placeholder="Password"
                    name="password"
                    v-model="$v.form.password.$model"
                    :state="validateState('password')"
                    aria-describedby="input-password-feedback"
                  ></b-form-input>
                  <b-form-invalid-feedback id="input-password-feedback"
                    >Password is required must be at least 6
                    characters</b-form-invalid-feedback
                  >
                </b-col>
              </b-row>

              <b-row class="py-4">
                <b-col sm="6" offset-sm="3">
                  <b-button
                    type="submit"
                    variant="primary"
                    class="btn btn-block signup-btn mt-2"
                    >
                    <span v-if="loading == false">Sign in</span>
                    <span v-if="loading == true">
                      <b-icon icon="circle-fill" animation="throb" font-scale="1.2" />
                      Signing in ...
                    </span>
                </b-button>
                </b-col>
              </b-row>

              <b-row class="py-3">
                <b-col sm="12">
                  <b-row class="">
                    <b-col sm="12">
                      <h6 class="mb-3 mt-3"><b>Don't have an account?</b></h6>
                    </b-col>
                  </b-row>
                  <b-row class="">
                    <b-col sm="6" offset-sm="3">
                      <b-button
                        type="button"
                        variant="light"
                        @click="redirectToHome()"
                        class="btn btn-block signin-btn mt-2 border"
                      >
                        <span>Sign Up </span>
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
import { login } from '@/api/services/auth'
import { validationMixin } from 'vuelidate'
import { required, minLength, email } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  data () {
    return {
      form: {
        email: null,
        password: null
      },
      show: true,
      loading: false
    }
  },
  validations: {
    form: {
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
    redirectToHome: function () {
      this.$router.push('/').catch(() => {})
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
        const result = await login(this.form)
        const tokenUser = result.data
        localStorage.setItem('session', JSON.stringify(tokenUser))
        this.$router.push('/timeline')
      } catch (err) {
        this.loading = false
        console.log('user create error ', err)
        alert('Email or password is incorrect !')
      }
    }
  }
}
</script>
