<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Chỉnh sửa thông tin nhân viên</h4>
            </div>
            <div class="card-body">
              <success :success="success"/>
                <form class="row g-3" @submit.prevent="updateUser">
                    <div class="col-md-12" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Họ và Tên</label>
                        <input v-model="fullname" type="text" name="fullname" class="form-control" id="inputFullname">
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
                        <Select v-model="division "
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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
  async asyncData({ params }) {
    const id = params.id;
    return {id}
  },
  components: {
  Success,
  Error
  },
  data() {
    return {
      account: {},
      divisions: [],
      postions: [],
      permissions: [],
      success: '',
      fullname: '',
      email: '',
      password: '',
      phonenumber: '',
      address: '',
      position: '',
      division: ''

    }
  },

  mounted() {
    axios.get('http://localhost:81/api/profileAccount/'+this.id)
    .then(response => {
      this.account = response.data.user;
      this.divisionName = response.data.division;
      this.fullname = this.account.fullname;
      this.email = this.account.email;
      this.address = this.account.address;
      this.phonenumber = this.account.phonenumber;
      this.division = this.account.division;
      this.position = this.account.position;

    }),

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
    updateUser() {
      axios.post('http://localhost:81/api/updateUser/' + this.id, {
        fullname:  this.fullname,
        email: this.email,
        password:this.pasword,
        address: this.address,
        phonenumber: this.phonenumber,
        division: this.division,
        position: this.position
      })
      .then(response => {
        this.success = response.data.message;
      })
    },

    updated() {
      axios.get('http://localhost:81/api/profileAccount/'+this.id)
      .then(response => {
        this.account = response.data.user;
        this.divisionName = response.data.division;
      })
    }
  }
}
</script>

<style>

</style>
