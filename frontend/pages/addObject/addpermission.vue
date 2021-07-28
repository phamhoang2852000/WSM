<template>
   <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Thêm quyền lợi</h4>
            </div>
            <div class="card-body">
              <success :success="success"/>
              <div class="col-md-6">
                 <form class="row g-3" @submit.prevent="addpermission" >
                    <div class="col-md-12 form-group" style="margin-top:20px">
                        <label for="inputFullname" class="form-lable">Tên quyền lợi</label>
                        <input v-model="permissionName" type="text"  name="division" class="form-control" id="inputFullname">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Add Permission</button>
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
export default {
  layout: 'master',
   components: {
    Success,
    Error,

  },
  data() {
    return {
      permissionName: '',
      success: ''
    }
  },

  methods: {
    addpermission() {
      axios.post('http://localhost:81/api/add-permission',{
        permissionName: this.permissionName
      })
      .then(response => {
        this.success = response.data.message;
      })
      .catch(error => {

      })
    }
  }
}
</script>

<style>

</style>
