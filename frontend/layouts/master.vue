<template>
  <div>
    <header class="header">
      <div class="brand">
        <a target="_blank" href="#" class="logo">

        </a>
        <a @click="show = !show" class="sidebar-toggle-box btn">
            <i id="bars" class="fa fa-bars"></i>
        </a>
      </div>

      <div class="top_nav" style="height:50px">
        <div class="nav_menu">
          <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">

                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user">{{user.fullname}}</i>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="/profile"> Profile</a>
                    <a class="dropdown-item"  href="/updateProfile">Cập nhật Profile</a>
                    <a class="dropdown-item"  href="/timework">Thời gian làm việc</a>
                    <a class="dropdown-item"  href="javascript:void(0)" @click="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
        </div>
      </div>
    </header>

       <!-- siderbar -->
    <aside>
      <div id="sidebar" class="nav-collapse"  v-if="show"  name="fade">
          <div class="leftside-navigation">
            <span v-if="user"></span>
            <ul class="sidebar-menu" style="margin-top: 50px">
                <li class="sub-menu">
                    <a href="/dashboard">
                        <i class="fa fa-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="/profile">
                        <i class="fa fa-info"></i>
                        <span>Thông tin tài khoản</span>
                    </a>
                </li>
                <li class="sub-menu">
                  <a @click="dropdown = !dropdown"  style="color:white; cursor:pointer">
                      <span>Yêu cầu</span>
                      <i style="margin-left: 5px" class="fa fa-caret-down"></i>
                    </a>
                  <ul class="sub" v-show="dropdown">
                    <a class="dropdown-sub" href="/requestuser"><i class="fa fa-credit-card"></i><span>Yêu cầu của tôi</span></a>
                    <a class="dropdown-sub" href="/addRequest"><i class="fa fa-plus"></i><span>Tạo yêu cầu mới</span></a>
                  </ul>
                </li>
                <li class="sub-menu" v-for="permission in permissionUser" v-bind:key="permission">
                  <a style="cursor:pointer; color:white" @click="showpermission(permission)" ><span>{{permissions[permission-1].name}}</span></a>
                </li>
                <!-- <li class="sub-menu">
                    <a href="/register">
                        <i class="fa fa-user-plus"></i>
                        <span>Tạo tài khoản mới</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="/listrequest">
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Phê duyệt yêu cầu</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a @click="check = !check"  style="color:white; cursor:pointer">
                        <i class="fa fa-list-alt"></i>
                        <span>Danh sách nhân viên</span>
                    </a>
                    <ul class="sub" v-show="check" v-for="(division) in divisions" v-bind:key="division.id" :value="division.id">
                    <li><a style="cursor:pointer" @click="showUser(division)" class="dropdown-sub" ><span>{{division.name}}</span></a></li>
                  </ul>
                </li>

                <li class="sub-menu">
                    <a @click="time = !time"  style="color:white; cursor:pointer">
                        <i class="fa fa-clock-o"></i>
                        <span>Thời gian làm việc </span>
                    </a>
                    <ul class="sub" v-show="time" v-for="(division) in divisions" v-bind:key="division.id" :value="division.id">
                    <li><a style="cursor:pointer" @click="showtimeUser(division)" class="dropdown-sub" ><span>{{division.name}}</span></a></li>
                  </ul>
                </li>

                <li class="sub-menu">
                  <a @click="add = !add"  style="color:white; cursor:pointer">
                      <i class="fa fa-plus"></i>
                      <span>Thêm mới đối tượng</span>
                  </a>
                  <ul class="sub" v-show="add">
                    <a class="dropdown-sub" href="/addObject/adddivision"><span>Thêm phòng ban mới</span></a>
                    <a class="dropdown-sub" href="/addObject/addposition"><span>Thêm chức vụ mới</span></a>
                    <a class="dropdown-sub" href="/addObject/addpermission"><span>Thêm quyền lợi</span></a>
                  </ul>
                </li> -->
            </ul>

        </div>
      </div>
    </aside>


	  <div id="content" class="main-content">
        <Nuxt/>
        <!-- Name: {{user.fullname}} -->
    </div>

</div>

</template>

<script>
const axios = require('axios');

export default {


  data() {
    return {
      user: {},
      show: true,
      dropdown: false,
      check: false,
      time: false,
      add: false,
      divisions: [],
      permissionUser: [],
      permissions: []
    }
  },


  mounted() {
    axios.get('http://localhost:81/api/auth/profile', {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {
      this.user = response.data.user;
      this.permissionUser = response.data.permission;
    })
    .catch(error => {
      console.log(error.response.data);
    }),

    axios.get('http://localhost:81/api/division').then(response => {
      this.divisions = response.data;
    }),

    axios.get('http://localhost:81/api/permission').then(response => {
      this.permissions = response.data;

    })
  },

  methods: {
    logout() {
      localStorage.removeItem('token');
      this.$router.push({name: 'login'});
    },

    showUser(division) {
      // console.log(division);
      this.$router.push('/listUser/'+ (division.id));
    },

    showtimeUser(division) {
      this.$router.push('/listtimeworkUser/'+ (division.id));
    },

    showpermission(permission) {
      this.$router.push(this.permissions[permission-1].path);
    }
  }

}
</script>

<style>
a{
  color:white;
}
.top_nav i {
  color: black;
}
.header{
  left:0;
    right:0;
    z-index:1002;
    background:#2A3F54;
    -webkit-transition:all .3s ease-in-out;
    -moz-transition:all .3s ease-in-out;
    -o-transition:all .3s ease-in-out;
    transition:all .3s ease-in-out;
}
.fixed-top {
   position:fixed;
    box-shadow:1px 0 3px rgba(0,0,0,.15);
}
.brand{
  background:#2A3F54;
    width: 100%;
    float: left;
    position: fixed;
    top: 0px;
    z-index: 1005;
    width: 230px;
    height: 56px;
    display: flex;
}


.brand .sidebar-toggle-box i{
  margin-left: 240px;
  line-height: 40px;
  font-size: 22px;
}

#sidebar {
    width:230px;
    height:527px;
    position:fixed;
    opacity: 1;
    background:#2A3F54;
    -webkit-transition:all .3s ease-in-out;
    -moz-transition:all .3s ease-in-out;
    -o-transition:all .3s ease-in-out;
    transition:all .3s ease-in-out;
    overflow-x: hidden;
    overflow-y: auto;
}

::-webkit-scrollbar {
  width: 10px;
}
#sidebar.show{
  width: 100px;
}
#sidebar a {
  text-decoration: none;
}
#sidebar ul li {
    position: relative;
    list-style-type: none;
}
.nav-collapse.collapse {
    display:inline;
}

ul.sidebar-menu,ul.sidebar-menu li ul.sub {
    margin:-2px 0 0;
    padding:0;
}

#sidebar>ul>li>ul.sub {
    display:none;
    visibility: hidden;
  opacity: 0;
  position: absolute;
  transition: all 0.5s ease;
  margin-top: 1rem;
  left: 0;
  display: none;
}

ul li:hover > ul,
ul li ul:hover {
  visibility: visible;
  opacity: 1;
  display: block;
}
#sidebar .sub-menu>.sub li a {
    padding-left:46px;
}
#sidebar>ul>li.active>ul.sub,#sidebar>ul>li>ul.sub>li>a {
    display:block;
}
ul.sidebar-menu li ul.sub li {
    background:rgba(52, 48, 48, 0);
    margin-bottom:0;
    margin-left:0;
    margin-right:0;
}
ul.sidebar-menu li ul.sub li a {
    font-size:12px;
    padding-top:13px;
    padding-bottom:13px;
    -webkit-transition:all 0.3s ease;
    -moz-transition:all 0.3s ease;
    -o-transition:all 0.3s ease;
    -ms-transition:all 0.3s ease;
    transition:all 0.3s ease;
    color:#fff;
}
ul.sidebar-menu li ul.sub li a:hover,ul.sidebar-menu li ul.sub li.active a {
    color:#fff;
    -webkit-transition:all 0.3s ease;
    -moz-transition:all 0.3s ease;
    -o-transition:all 0.3s ease;
    -ms-transition:all 0.3s ease;
    transition:all 0.3s ease;
    display:block;
    background:rgba(40, 40, 46, 0.28);
}
ul.sidebar-menu li {
    border-bottom:1px solid rgba(255,255,255,0.05);
}
ul.sidebar-menu li.sub-menu {
    line-height:15px;
}
ul.sidebar-menu ul.sub li {
    border-bottom:none;
}
ul.sidebar-menu li a span {
    display:inline-block;
}
ul.sidebar-menu li a {
    color:#fff;
    text-decoration:none;
    display:block;
    padding:18px 0 18px 25px;
    font-size:12px;
    outline:none;
    -webkit-transition:all 0.3s ease;
    -moz-transition:all 0.3s ease;
    -o-transition:all 0.3s ease;
    -ms-transition:all 0.3s ease;
    transition:all 0.3s ease;
}
ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
    background: rgba(40, 40, 46, 0.28);
    color: #fff;
    display: block;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
ul.sidebar-menu li a i {
    font-size:15px;
    padding-right:6px;
}
ul.sidebar-menu li a:hover i,ul.sidebar-menu li a:focus i {
    color:#fff;
}
ul.sidebar-menu li a.active i {
    color:#fff;
}

.dropdown-sub span{
  margin-left: 20px;
}
.main-content{
   margin-left:240px;
   margin-top: 20px;

}
.wrapper {
    display:inline-block;
    margin-top:70px;
    padding:15px;
    width:100%;
}

.btn{
  cursor: pointer;
}

.fade-enter-active, .fade-leave-active {
  opacity: 1;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;

}

</style>
