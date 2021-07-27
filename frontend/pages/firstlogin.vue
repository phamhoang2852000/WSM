<template>
  <div class="container">
	<div class="row  justify-content-center">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">New Password</h2>
                  <p>You need to reset your password the first time you log in.</p>
                  <div class="panel-body">

                    <form id="register-form" @submit.prevent="firstlogin">

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input v-model="newpassword" id="password" name="newpassword" placeholder="new password" class="form-control"  type="password">
                        </div>
                      </div>
                      <button class="btn btn-primary btn-block">New Password</button>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</template>

<script>
const axios = require('axios')
export default {

  data() {
    return {
      newpassword: ''
    }
  },

  methods: {
    firstlogin() {
      axios.post('http://localhost:81/api/auth/firstlogin', {
          newpassword: this.newpassword
        }
        ,{
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(response => {
        this.$router.push('/login');
      })
      .catch(error => {

      })
    }
  }
}
</script>

<style>

</style>
