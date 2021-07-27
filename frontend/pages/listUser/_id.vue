<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Danh sách nhân viên {{ this.divisionName}}</h4>
            </div>
            <div>
              <button class="btn btn-success" style="margin-top:20px; margin-left:20px; height:40px; width:200px">In danh sách nhân viên</button>
            </div>
            <div class="card-body">
               <div class="table-responsive" style="margin-top:30px">
          <table class="table" >
            <thead>
              <tr>
                <th>Số thứ tự</th>
                <th>Họ Tên</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Ngày sinh</th>
                <th>Chức vụ</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list, index) in listUser" :value="list.id" v-bind:key="list.id" >
                <th>{{index + 1}}</th>
                <th>{{list.fullname}}</th>
                <!-- <th v-if="list.sex==1">Nam</th>
                <th v-else="list.sex==2">Nữ</th> -->
                <th>
                  <span v-if="list.sex==1">Nam</span>
                  <span v-else>Nữ</span>
                </th>
                <th>{{ list.email }}</th>
                <th>{{ list.phonenumber }}</th>
                <th>{{ list.date_of_birth }}</th>
                <th>{{ list.position }}</th>
                <th>
                  <button @click="updateUser(list)" class="btn btn-success">Chi tiết</button>
                </th>
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
    async asyncData({ params }) {
      const id = params.id;
      return {id}
    },
  data() {
    return {
      listUser: [],
      divisionName: '',
      userid: ''
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/list-user/'+this.id)
    .then(response => {
      this.listUser = response.data.listUser;
      this.divisionName = response.data.divisionName;

    })
  },

  methods: {

    updateUser(list){
      this.userid = list.id;
       this.$router.push('/User/'+ (this.userid));
    }

  }
}
</script>

<style>
table, th, tr, td{
    border:1px solid black;
    text-align: center;
}
table{
    border-collapse:collapse;
}
.container {
  color: black;
  margin-top:20px;
}
</style>
