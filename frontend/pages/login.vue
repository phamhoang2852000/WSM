<template>

<div class="login">
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form @submit.prevent="login">
          <h1>Login Form</h1>
          <div>
            <input v-model="user.email" type="text" class="form-control" placeholder="Email" required="" />
          </div>
          <div>
            <input v-model="user.password" type="password" class="form-control" placeholder="Password"/>
          </div>
          <div>
            <button class="btn btn-primary">Log in</button>
            <a  class="btn btn-primary" href="/forget-password">Forgot your password?</a>
          </div>

          <div class="clearfix"></div>
        </form>
      </section>
    </div>
  </div>
</div>
</template>

<script>
const axios = require('axios');
    export default {
      name: "login",
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                },
                errors: {},
                firstlogin: ''
            }
        },

        methods: {
          login() {
            axios.post('http://localhost:81/api/auth/login', this.user)
            .then(response => {
              localStorage.setItem('token', response.data.token);
              this.firstlogin = response.data.user.firstlogin;
              if(this.firstlogin == 0) {
                this.$router.push('/firstlogin');
              }
              else {
                this.$router.push({name: 'dashboard'});
              }
            })
            .catch(error => {
              this.errors = error.response.data.errors;
            })
          },


        }
  }
</script>

<style scoped>
body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: linear-gradient(to right, #b92b27, #1565c0)
}

.card {
    margin-bottom: 20px;
    border: none
}

.box {
    width: 500px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    background: #191919;
    ;
    text-align: center;
    transition: 0.25s;
    margin-top: 100px
}

.box input[type="text"],
.box input[type="password"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 10px 10px;
    width: 250px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s
}

.box h1 {
    color: white;
    text-transform: uppercase;
    font-weight: 500
}

.box input[type="text"]:focus,
.box input[type="password"]:focus {
    width: 300px;
    border-color: #2ecc71
}

.box input[type="submit"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer
}

.box input[type="submit"]:hover {
    background: #2ecc71
}

.forgot {
    text-decoration: underline
}

ul.social-network {
    list-style: none;
    display: inline;
    margin-left: 0 !important;
    padding: 0
}

ul.social-network li {
    display: inline;
    margin: 0 5px
}

.social-network a.icoFacebook:hover {
    background-color: #3B5998
}

.social-network a.icoTwitter:hover {
    background-color: #33ccff
}

.social-network a.icoGoogle:hover {
    background-color: #BD3518
}

.social-network a.icoFacebook:hover i,
.social-network a.icoTwitter:hover i,
.social-network a.icoGoogle:hover i {
    color: #fff
}

a.socialIcon:hover,
.socialHoverClass {
    color: #44BCDD
}

.social-circle li a {
    display: inline-block;
    position: relative;
    margin: 0 auto 0 auto;
    border-radius: 50%;
    text-align: center;
    width: 50px;
    height: 50px;
    font-size: 20px
}

.social-circle li i {
    margin: 0;
    line-height: 50px;
    text-align: center
}

.social-circle li a:hover i,
.triggeredHover {
    transform: rotate(360deg);
    transition: all 0.2s
}

.social-circle i {
    color: #fff;
    transition: all 0.8s;
    transition: all 0.8s
}
</style>
