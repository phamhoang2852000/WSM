<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Thông tin chi tiết nhân viên</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive " style="margin-top:30px">
                <table class="table" >
                   <tbody>
                      <tr>
                        <td>Họ Tên</td>
                        <td>{{ account.fullname }}</td>
                      </tr>
                       <tr>
                        <td>Email</td>
                        <td>{{ account.email }}</td>
                      </tr>
                      <tr>
                        <td>Giới tính</td>
                        <td v-if="account.sex == 1">Nam</td>
                        <td v-if="account.sex == 0">Nữ</td>
                      </tr>
                      <tr>
                        <td>Địa chỉ</td>
                        <td>{{ account.address }}</td>
                      </tr>
                       <tr>
                        <td>Số điện thoại</td>
                        <td>{{ account.phonenumber }}</td>
                      </tr>
                      <tr>
                        <td>Ngày sinh</td>
                        <td>{{ account.date_of_birth }}</td>
                      </tr>
                      <tr>
                        <td>Đơn vị</td>
                        <td>{{ this.divisionName }}</td>
                      </tr>
                      <tr>
                        <td>Chức vụ</td>
                        <td>{{ account.position }}</td>
                      </tr>
                      <tr>
                        <td>Các quyền </td>
                        <td>
                          <span v-for="per in permissionUser" :key="per" style="text-align:left">- {{permissions[per-1].name}}. <br></span>
                        </td>
                      </tr>
                    </tbody>
                </table>
                <button @click="updateUser" style="margin-top:30px" class="btn btn-success">Chỉnh sửa thông tin</button>
                <button @click="deleteUser" style="margin-top:30px" class="btn btn-danger">Xóa tài khoản</button>
              </div>


            </div>

       </div>
   </div>
</template>

<script>
const axios = require('axios')
export default {
  layout: 'master',
    async asyncData({ params }) {
      const id = params.id;
      return {id}
    },
  data() {
    return {
      account: {},
      divisionName: '',
      permissionUser: [],
      permissions: []
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/profileAccount/'+this.id)
    .then(response => {
      this.account = response.data.user;
      this.divisionName = response.data.division;
      this.permissionUser = response.data.permission;
      console.log(this.permissionUser);

    }),

    axios.get('http://localhost:81/api/permission').then(response => {
      this.permissions = response.data;

    })

  },

  methods: {
      deleteUser() {
        let answer = confirm('Bạn có muốn xóa tài khoản này không?');
        if(answer == true) {
          axios.get('http://localhost:81/api/deleteUser/'+this.id)
          .then(response => {
              this.$router.push('/dashboard');
          })
          .catch(error => {

          })
        }

      },

      updateUser() {
        this.$router.push('/User/updateUser/'+(this.id));
      }
  }
}
</script>

<style>
table, th, tr, td{
    border:1px solid black;
    text-align: center;
    border-top: 1px solid black;
}
table{
    border-collapse:collapse;

}
.table {
  width: 550px;
}
.container {
  color: black;
  margin-top:20px;
}
</style>
