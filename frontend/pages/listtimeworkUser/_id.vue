<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Thời gian làm việc của nhân viên {{ this.divisionName}}</h4>
            </div>
            <div>
              <button class="btn btn-success" style="margin-top:20px; margin-left:20px; height:40px; width:200px">In danh sách</button>
            </div>
            <div class="card-body">
               <div class="table-responsive" style="margin-top:30px">
          <table class="table" >
            <thead>
              <tr>
                <th>Ngày tháng</th>
                <th>Họ Tên</th>
                <th>Thời gian checkin</th>
                <th>Thời gian checkout</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(list) in listtimedivision" :value="list.id" v-bind:key="list.id" >
                <th>{{list.datecheck}}</th>
                <th>{{ list.user }}</th>
                <th>{{ list.start_time }}</th>
                <th>{{ list.end_time }}</th>
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
      divisionName: '',
      listtimedivision: []
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/timework-user/'+this.id)
    .then(response => {
      this.listtimedivision = response.data.listtimedivision;
      this.divisionName = response.data.divisionName;
      console.log(response.data.listtimedivision);
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
