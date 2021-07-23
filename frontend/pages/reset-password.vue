<template>
  <main>
    <div class="login-form">
      <h2 class="text-center title-login">
        Enter your new password
      </h2>

      <ValidationObserver v-slot="{ invalid }" ref="form">
        <form @submit.prevent="resetPassword">
          <div class="form-group">
            <ValidationProvider v-slot="{ errors }" vid="new_password" rules="required|min:6">
              <input
                v-model="userForm.new_password"
                type="password"
                class="form-control"
                name="new_password"
                placeholder="new password"
              >
              <span class="form-error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="form-group">
            <ValidationProvider
              v-slot="{ errors }"
              vid="confirm_new_password"
              rules="required|min:6|confirmed:new_password"
            >
              <input
                v-model="userForm.confirm_new_password"
                type="password"
                class="form-control"
                name="confirm_new_password"
                placeholder="confirm new password"
              >
              <span class="form-error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <success :success="success" />
          <error :error="error" />

          <div class="form-group">
            <button type="submit" :disabled="invalid || startSubmit" class="btn btn-success btn-block login-btn">
              Confirm
            </button>
          </div>
        </form>
      </ValidationObserver>
    </div>
  </main>
</template>
<script>
import { ValidationObserver, ValidationProvider } from 'vee-validate'
import Success from '@/components/message/success'
import Error from '@/components/message/error'
const axios = require('axios');
export default {
  components: {
    Error,
    Success,
    ValidationObserver,
    ValidationProvider
  },
  data () {
    return {
      userForm: {
        new_password: '',
        confirm_new_password: ''
      },
      error: '',
      success: '',
      startSubmit: false,
      token: ''
    }
  },
  head: {
    title: 'reset password'
  },



  methods: {
    resetPassword() {
      axios.post('http://localhost:81/api/reset-password/' + localStorage.getItem('token'), this.userForm)
      .then(response => {
        this.startSubmit = true;
        this.success = response.data.message;
      })
      .catch(error => {
        this.error = error.response.data.message
      })
    }
  }
}
</script>

