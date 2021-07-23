<template>
   <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Tạo tài khoản mới</h4>
            </div>
            <div class="card-body">
                <form class="row g-3" @submit.prevent="register">
                    <div class="col-md-12" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Họ và Tên</label>
                        <input v-model="fullname" type="text" name="fullname" class="form-control" id="inputFullname">
                    </div>
                    <div class="col-md-12" style="margin:left: 30px;margin-top:20px" >
                        <label for="iputsex" class="form-lable">Giới tính</label>
                        <input type="radio" v-model="sex" name="sex" value="1" checked> Nam
                        <input type="radio" v-model="sex" name="sex" value="0"> Nữ
                        <input type="radio" v-model="sex" name="sex" value="2"> Khác
                    </div>
                    <div class="col-md-12" style="margin-top:20px">
                        <label for="inputDate" class="form-label">Ngày sinh</label>
                        <input style="margin-left:40px" v-model="date_of_birth" type="date" name="date_of_birth"><br><br>
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input v-model="email" type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input v-model="password" type="password" class="form-control" id="inputPassword4">
                    </div>
                    <div class="col-12" style="margin-top:20px">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input v-model="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-12" style="margin-top:20px">
                        <label for="inputphoneNumber" class="form-label">Số điện thoại</label>
                        <input v-model="phonenumber" type="text" class="form-control" id="inputphoneNumber" placeholder="0123456789">
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <Select v-model="division"
                        @change="updatedivision"
                          :values="divisions"
                          :title="'Đơn vị'"
                          :data="'division'"
                        />

                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <Select
                         v-model="position"
                        @change="updatepostion"
                          :values="postions"
                          :title="'Chức vụ'"
                        />
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <InputCheck
                          :values="permissions"
                          :title="'Các quyền lựa chọn'"

                        />
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                      <div class="form-group">
                        <label for="inputDivision" class="form-label">Người hướng dẫn </label>
                        <select  class="form-control " id="division" name="division">
                          <option>Nguyễn Văn A</option>
                          <option>Nguyễn Văn B</option>
                          <option>Nguyễn Văn C</option>
                          <option>Nguyễn Văn D</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12" style="margin-top:30px">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>

       </div>
   </div>
</template>

<script>
import Select from '../components/Select.vue';
import InputCheck from '../components/InputCheck.vue';
const axios = require('axios');

export default {
  layout: 'master',
  components: {
    Select,
    InputCheck
  },
  data() {
    return {
      postions: [],
      divisions: [],
      permissions: [],

      // user: {},
      fullname: '',
      sex: '',
      email: '',
      password: '',
      date_of_birth: '',
      address: '',
      phonenumber: '',
      division: '',
      position: '',
      errors: [],
    }
  },
  mounted() {
    axios.get('http://localhost:81/api/postion').then(response => {
      this.postions = response.data;

    }),
    axios.get('http://localhost:81/api/division').then(response => {
      this.divisions = response.data;

    }),
    axios.get('http://localhost:81/api/permission').then(response => {
      this.permissions = response.data;

    })
  },

  methods: {
    updatedivision(value_from_child) {
      // console.log(value_from_child);
      this.division = value_from_child;

    },
    updatepostion(value_from_child){
       this.position = value_from_child;
    },
    register() {
      console.log(this.division)
      axios.post('http://localhost:81/api/auth/register', {
        fullname: this.fullname,
        email: this.email,
        password: this.password,
        sex: this.sex,
        date_of_birth: this.date_of_birth,
        address: this.address,
        phonenumber: this.phonenumber,
        division: this.division,
        position: this.position
      })
      .then(response => {
        // this.user = {}
      })
      .catch(error => {
        this.errors = error.response.data.errors;
      })
    }
  }
}
</script>
<style>
</style>
