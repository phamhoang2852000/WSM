<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 card-header">
      <h4>Yêu cầu của tôi</h4>
    </div>
    <div class="card-body">
      <div id="menu_request">
        <ul>
          <li @click="show = 1"><a href="#">Các yêu cầu được duyệt</a></li>
          <li @click="show = 2"><a href="#">Các yêu cầu chưa được duyệt</a></li>
          <li @click="show = 3"><a href="#">Các yêu cầu bị từ chối</a></li>
        </ul>
      </div>
      <div style="margin-left:20px">
        <a href="/addRequest" class="btn btn-success" style="font-size:15px; color:black border:1px solid black; width:150px; height:50px"><i style="font-size: 25px; text-align:center" class="icon-plus22"></i>Thêm yêu cầu</a>
      </div>
      <!-- <a href="/addRequest" class="btn btn-success" style="font-size:15px; color:black border:1px solid black; width:150px; height:50px; margin-left:-120px; margin-top: 60px"><i style="font-size: 25px; text-align:center" class="icon-plus22"></i>Thêm yêu cầu</a> -->
        <div class="space80"></div>
        <div class="table-responsive" style="margin-top:30px" v-if="show == 1">
          <table class="table" >
            <thead>
              <tr>
                  <th>Nội dung</th>
                  <th>Tình trạng</th>
                  <th>Người phê duyệt</th>
                  <th>Thời gian</th>
                  <th>Lý do</th>
              </tr>
            </thead>
            <tbody v-for="accept in acceptRequest" :key="accept" >
              <tr>
                <th>{{accept.id_requesttype}}</th>
                <th><span class="btn btn-success">Đồng ý</span></th>
                <th>{{accept.id_approve}}</th>
                <th>{{accept.time_under}} - {{accept.time_on}}</th>
                <th>{{accept.description}}</th>
              </tr>
            </tbody>
          </table>
        </div>

         <div class="table-responsive" style="margin-top:30px" v-else-if="show == 2">
          <table class="table">
            <thead>
              <tr>
                  <th>Nội dung</th>
                  <th>Tình trạng</th>
                  <th>Thời gian</th>
                  <th>Lý do</th>
              </tr>
            </thead>
            <tbody v-for="waitrequest in waitRequest" :key="waitrequest" style="text-align:center">
              <tr>
                <th>{{waitrequest.id_requesttype}}</th>
                <th><span class="btn btn-warning">Đang chờ phê duyệt</span></th>
                <th>{{waitrequest.time_under}} - {{waitrequest.time_on}}</th>
                <th>{{waitrequest.description}}</th>
              </tr>
            </tbody>
          </table>
        </div>

         <div class="table-responsive" style="margin-top:30px" v-else-if="show == 3">
          <table class="table">
            <thead>
              <tr>
                  <th>Nội dung</th>
                  <th>Tình trạng</th>
                  <th>Người phê duyệt</th>
                  <th>Thời gian</th>
                  <th>Lý do</th>
              </tr>
            </thead>
            <tbody v-for="unaccept in unacceptRequest" :key="unaccept" style="text-align:center">
              <tr>
                <th>{{unaccept.id_requesttype}}</th>
                <th><span class="btn btn-danger">Từ chối</span></th>
                <th>{{unaccept.id_approve}}</th>
                <th>{{unaccept.time_under}} - {{unaccept.time_on}}</th>
                <th>{{unaccept.description}}</th>
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
      show: 1,
      acceptRequest: [],
      waitRequest: [],
      unacceptRequest: []
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/auth/acceptRequest',  {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then(response => {
      this.acceptRequest = response.data;
    }),

     axios.get('http://localhost:81/api/auth/awitRequest',  {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then(response => {
      this.waitRequest = response.data;
    }),

     axios.get('http://localhost:81/api/auth/unacceptRequest',  {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    .then(response => {
      this.unacceptRequest = response.data;
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

#menu_request ul {
  margin-left: 20px;
  padding: 0px;
}

#menu_request ul li {
  list-style: none;
  float: left;
  border: 1px solid black;
  height: 50px
}

#menu_request ul li a {
  color: black;
  text-decoration: none;
  line-height: 50px;
  padding: 0px 15px 0px 15px;
  cursor: pointer;
}

#menu_request ul li.active {
  background: red;
}


</style>
