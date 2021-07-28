<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Cập nhật tài khoản</h4>
            </div>
            <div class="card-body">
              <success :success="success"/>
              <div class="col-md-6">
                 <form class="row g-3" @submit.prevent="updateUser" >
                    <div class="col-md-12 form-group" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Họ và Tên</label>
                        <input v-model="fullname" type="text"  name="fullname" class="form-control" id="inputFullname">
                    </div>
                    <div style="margin-top:20px">
                      <label for="avatar" class="form-lable">Ảnh đại diện</label>
                      <center>
                        <!-- <img style="border-radius: 50%; height: 200px; width: 200px;" v-bind:src="url" /> -->
                        <div style="margin-top:20px">
                          <label for="file">Choose a file</label>
                          <input @change="loadFile" type="file" class="file" id="avatar" name="avatar"
                              multiple data-preview-file-type="any" data-upload-url="#"
                              ref="file" accept="image/*" >
                        </div>
                      </center>
                    </div>

                    <div class="col-md-12 form-group" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Địa chỉ</label>
                        <input v-model="address" type="text"  name="address" class="form-control" id="inputFullname">
                    </div>

                    <div class="col-md-12 form-group" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Số điện thoại</label>
                        <input v-model="phonenumber" type="text"  name="phonenumber" class="form-control" id="inputFullname">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
              </div>

            </div>

       </div>
   </div>
</template>

<script>
const axios = require('axios')
import Success from '@/components/message/success';
import Error from '@/components/message/error';
import InputCheck from '../components/InputCheck.vue';
export default {
  layout: 'master',
  components: {
    Success,
    Error,
    InputCheck
  },
  data() {
    return {
      fullname: '',
      address: '',
      phonenumber: '',
      avatar: '',
      url: '',
      imagepreview: null,
      success: '',
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
      this.url = 'image/'+ response.data.user.avatar;
      this.fullname = response.data.user.fullname;
      this.address = response.data.user.address;
      this.phonenumber = response.data.user.phonenumber;
      this.avatar = response.data.user.avatar;

    })
    .catch(error => {
      // console.log(error.response.data.error);
    })
  },

  methods: {
    loadFile(event) {
      this.avatar = event.target.files[0].name;

    },

     updatepermission(value_from_child) {
      this.permission = value_from_child;
      // console.log(this.permission);
      console.log(this.permission);
    },

    updateUser() {
      axios.post('http://localhost:81/api/auth/updateUser', {
        fullname: this.fullname,
        address: this.address,
        phonenumber: this.phonenumber,
        avatar: this.avatar,
      }, {
         headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
        // fullname: this.fullname,
        // avatar: this.avatar,
        // phonenumber: this.phonenumber,
        // address: this.address
      })
      .then(response => {
       this.success = response.data.message;
      })
      .catch(error => {
        this.$refs.form.setErrors(error.response.data.errors);
      })
    }
  }
}
</script>

<style>
table, th, tr, td{
    border:1px solid black;
}


</style>
