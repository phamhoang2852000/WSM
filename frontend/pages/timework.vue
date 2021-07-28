<template>
  <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 card-header">
      <h4>Thời gian làm việc</h4>
    </div>
    <div class="card-body">
        <div class="space80"></div>
        <div class="table-responsive col-md-6" style="margin-top:30px">
          <h4>Thời gian làm việc</h4>
          <table class="table" >
            <thead>
              <tr>
                  <th>Ngày tháng</th>
                  <th>Thời gian checkin</th>
                  <th>Thời gian checkout</th>
                  <th></th>
              </tr>
            </thead>
            <tbody v-for="time in timework" :key="time" >
              <tr>
                <th>{{time.datecheck}}</th>
                <th>{{time.start_time}}</th>
                <th>{{time.end_time}}</th>
                <th></th>
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
        timework: []
      }
  },

  mounted() {
    axios.get('http://localhost:81/api/auth/profile', {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {
      // this.user = response.data;
      // console.log(response.data);
      //  token: this.$router.params.token;
    })
    .catch(error => {
      console.log(error.response.data);
    }),

    axios.get('http://localhost:81/api/auth/timework', {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {
      this.timework = response.data.timework;
      console.log(this.timework);
    })
    .catch(error => {

    })
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
