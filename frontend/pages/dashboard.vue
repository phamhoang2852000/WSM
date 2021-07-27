<template>
<div id="calendar">
  <button @click="isCheck = !isCheck,check()" class="btn btn-success"><i class="fa fa-sign-in" style="margin-right: 10px"></i>
    <span v-if="isCheck == true">Check in</span>
    <span v-else>Check out</span>
  </button>
  <FullCalendar
    :options="calendarOptions"
  />
</div>

</template>

<script>
const axios = require('axios')
import FullCalendar from '@fullcalendar/vue'
import interactionPlugin from '@fullcalendar/interaction'
import dayGridPlugin from '@fullcalendar/daygrid'


export default {
  layout: 'master',
  components: {
    FullCalendar
  },
  data() {
    return {
      isCheck: true,
      calendarOptions: {
        plugins: [interactionPlugin, dayGridPlugin],
        events: [],
        eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          hour12: false
        }
      },

      start_time: '',
      end_time: '',
      datecheck: '',
      result: []
    }
  },

  mounted() {
    axios.get('http://localhost:81/api/auth/showcheck', {
      headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then(response => {

      this.result = response.data.check;

       for(let i = 0; i<this.result.length; i++) {

        if(this.result[i].start_time != null) {
          this.calendarOptions.events.push(
            {title: this.result[i].start_time, date: this.result[i].datecheck},
          )
        }

        if(this.result[i].end_time != null) {
          this.calendarOptions.events.push(
            {title: this.result[i].end_time, date: this.result[i].datecheck},
          )
        }

       }

    })
    .catch(error => {

    })
  },

  methods: {

    check() {
      if(this.isCheck == false) {
          var today = new Date();
          if(today.getMonth()+1<10) {
            this.datecheck = today.getFullYear()+'-0'+(today.getMonth()+1)+'-'+today.getDate();
          }
          else {
            this.datecheck = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
          }
          let time = today.getHours() + ":" + today.getMinutes();
          this.start_time = time;
          axios.post('http://localhost:81/api/auth/checkin', {
            datecheck: this.datecheck,
            start_time: this.start_time,
        },
        {
           headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => {
          this.calendarOptions.events = [
            ...this.calendarOptions.events,
            { title: response.data.checkin.start_time, date: response.data.checkin.datecheck },
          ];
        })
        .catch(error => {

        })
      }
      else {
        var today = new Date();
        if(today.getMonth()+1<10) {
            this.datecheck = today.getFullYear()+'-0'+(today.getMonth()+1)+'-'+today.getDate();
        }
        else {
          this.datecheck = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        }
        let time = today.getHours() + ":" + today.getMinutes();
        this.end_time = time;
          axios.post('http://localhost:81/api/auth/checkout', {
            datecheck: this.datecheck,
            end_time: this.end_time,
        },
        {
           headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => {
          this.calendarOptions.events = [
            ...this.calendarOptions.events,
            { title: response.data.checkout.end_time, date: response.data.checkout.datecheck },
          ];
        })
        .catch(error => {

        })
      }

    },
  }

}

</script>

<style>
.container {
  color: black;
  margin-left:0
}

</style>
