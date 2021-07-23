<template>
  <main>
    <div class="container">
      <div class="login-form">
        <h2 class="text-center title-login">
          Reset password
        </h2>
        <ValidationObserver v-slot="{ invalid }" ref="form">
          <form @submit.prevent="forgetPassword">
            <div class="form-group">
              <ValidationProvider v-slot="{ errors }" vid="email" rules="required|email">
                <input
                  v-model="userForm.email"
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="email"
                >
                <span class="form-error">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>

            <success :success="success"/>

            <div class="form-group">
              <button type="submit" :disabled="invalid || startSubmit" class="btn btn-success btn-block login-btn">
                Confirm
              </button>
            </div>
          </form>
        </ValidationObserver>
      </div>
    </div>
  </main>
</template>
<script>
import {ValidationObserver, ValidationProvider} from 'vee-validate'
import Success from '@/components/message/success'
const axios = require('axios')
export default {
  components: {
    Success,
    ValidationObserver,
    ValidationProvider
  },
  data() {
    return {
      userForm: {
        email: ''
      },
      success: '',
      startSubmit: false
    }
  },
  head: {
    title: 'reset password'
  },

  methods: {
    // async forgetPassword() {
    //   try {
    //     this.startSubmit = true
    //     const response = await this.$axios.post('reset-password', this.userForm)
    //     this.success = response.data.message
    //   } catch (error) {
    //     this.$refs.form.setErrors(error.response.data.errors)
    //   }
    // }

    forgetPassword() {
      axios.post('http://localhost:81/api/reset-password', this.userForm)
      .then(response => {
        this.startSubmit = true;
        this.success = response.data.message;
        console.log(response.data);
        localStorage.setItem('token', response.data.token);
      })
      .catch(error => {
        this.$refs.form.setErrors(error.response.data.errors);
      })
    }
  }
}
</script>
