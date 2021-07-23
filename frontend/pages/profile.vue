<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 card-header">
      <h4>Thông tin tài khoản</h4>
    </div>
    <div class="card-body">
      <a href="/updateProfile" class="btn btn-success" style="background-color:white; border:1px solid black; width:50px; height:50px; margin-left:20px"><i style="font-size: 25px; text-align:center; color:black" class="fa fa-pencil"></i></a>
        <div class="space80"></div>
        <div class="table-responsive col-md-6" style="margin-top:30px">
          <h4>Thông tin nhân viên</h4>
          <table class="table">
            <tbody>
              <tr>
                <td>Email</td>
                <td>{{ user.email }}</td>
              </tr>
              <tr>
                <td>Họ Tên</td>
                <td>{{ user.fullname }}</td>
              </tr>
              <tr>
                <td>Giới tính</td>
                <td v-if="user.sex == 1">Nam</td>
                <td v-if="user.sex == 0">Nữ</td>
              </tr>
              <tr>
                <td>Địa chỉ</td>
                <td>{{ user.address }}</td>
              </tr>
              <tr>
                <td>Ngày sinh</td>
                <td>{{ user.date_of_birth }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
</template>

<script>
const axios = require('axios')
export default {
  layout: 'master',
  data() {
    return {
      user: {},
    }
  },


  mounted() {
    axios.get('http://localhost:81/api/auth/profile', {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {
      this.user = response.data;
      console.log(response.data);
      //  token: this.$router.params.token;
    })
    .catch(error => {
      console.log(error.response.data);
    })
  },


}
</script>

<style>
table, th, tr, td{
    border:1px solid black;
}
/* table{
    border-collapse:collapse;
} */

</style>
