<template>
  <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 card-header">
      <h4>Các yêu cầu cần kiểm duyệt</h4>
    </div>
    <div class="card-body">
      <success :success="success"/>
        <div class="table-responsive" style="margin-top:30px">
          <table class="table" >
            <thead>
              <tr>
                  <th>Người yêu cầu</th>
                  <th>Nội dung</th>
                  <th>Thời gian</th>
                  <th>Lý do</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list, index) in listRequest" :value="list.id" v-bind:key="list.id" >
                <th>{{list.id_user}}</th>
                <th>{{list.id_requesttype}}</th>
                <th>{{list.time_under}} - {{list.time_on}}</th>
                <th>{{list.description}}</th>
                <th>
                  <button @click="approve(index)"  class="btn btn-success">Phê duyệt</button>
                  <button @click="unapprove(index)" class="btn btn-danger">Từ chối</button>
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
import Success from '@/components/message/success';
import Error from '@/components/message/error'
export default {
  layout: 'master',

  components: {
    Success,
    Error
  },

  data() {
    return {
      listRequest: [],
      success: '',
      user_approve: '',
      id_request: ''
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/list-request')
    .then(response => {
      this.listRequest = response.data;
    }),

    axios.get('http://localhost:81/api/auth/profile', {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {
      this.user_approve = response.data.id;
    })
    .catch(error => {
      // console.log(error.response.data.error);
    })
  },

  methods: {
    approve(index) {
      let answer = confirm('Bạn có chắc muốn phê duyệt yêu cầu này?');
      this.id_request = this.listRequest[index].id;
      if(answer == true) {
        axios.post('http://localhost:81/api/approve-request',{
          id_approve: this.user_approve,
          id_request: this.id_request,
        })
        .then(response => {
          this.success = response.data.mesage;
        })
        .catch(error => {

        })
      }

    },
    unapprove(index) {
       let answer = confirm('Bạn có chắc muốn từ chối yêu cầu này?');
      this.id_request = this.listRequest[index].id;
      if(answer == true) {
        axios.post('http://localhost:81/api/unapprove-request',{
          id_approve: this.user_approve,
          id_request: this.id_request,
        })
        .then(response => {
          this.success = response.data.mesage;
        })
        .catch(error => {

        })
      }

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
