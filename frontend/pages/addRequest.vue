<template>
  <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-12 card-header">
              <h4>Tạo Yêu cầu mới</h4>
            </div>
            <success :success="success"/>
            <div class="card-body">
              <div class="col-md-6">
                <form class="row g-3" @submit.prevent="addRequest">
                    <div class="col-md-12" style="margin-top:20px">
                        <Select
                          @change="updaterequestType"
                          :values="requestType"
                          :title="'Nội dung'"
                          :data="'requestType'"
                        />

                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <label for="inputEmail4" class="form-label">Từ</label>
                        <input v-model="request.time_under" type="time" name="date_of_birth" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6" style="margin-top:20px">
                        <label for="inputEmail4" class="form-label">Đến</label>
                        <input v-model="request.time_on" type="time" name="date_of_birth" class="form-control" id="inputEmail4">
                    </div>
                    <div class="form-group">
                      <label for="comment">Lý do:</label>
                      <textarea v-model="request.description" class="form-control" rows="5" id="description" name="description" style=" resize: none;"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Add Request</button>
                    </div>

                </form>
              </div>

            </div>

       </div>
   </div>
</template>

<script>
import Select from '../components/Select.vue';
import InputCheck from '../components/InputCheck.vue';
import Success from '@/components/message/success'
import Error from '@/components/message/error'
const axios = require('axios');
export default {
  layout: 'master',
  components: {
    Select,
    InputCheck,
    Error,
    Success,
  },

  data() {
    return {
      success: '',
      requestType: [],
      request: {
        requestType: '',
        time_under: '',
        time_on: '',
        description: ''

      }
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/requestType').then(response => {
      this.requestType = response.data;
    })
  },

  methods: {
    updaterequestType(value_from_child) {
       this.request.requestType = value_from_child;
    },

    addRequest() {
      axios.post('http://localhost:81/api/auth/addRequest', this.request, {
        headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(response => {
        this.success = response.data.mesage;
        this.$router.push('/addRequest');
      })
      .catch(error => {
        this.$refs.form.setErrors(error.response.data.errors);
      })
    }
  }
}
</script>

<style>

</style>
