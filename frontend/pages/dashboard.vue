<template>
<div id="calendar">
  <button @click="isCheck = !isCheck, dateTime()" class="btn btn-success"><i class="fa fa-sign-in" style="margin-right: 10px"></i>
    <span v-if="isCheck == true">Check in</span>
    <span v-else>Check out</span>
  </button>
  <button class="btn btn-success"><span>{{this.time}}</span></button>
  <FullCalendar
    :options="calendarOptions"
    :customButtons="CustomButtons"
    :headerToolbar="headerToolbar"
  />
</div>

</template>

<script>

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
        dateClick: this.handleDateClick
      },

      time: ''
    }
  },



  methods: {
    handleDateClick: function(arg) {
      alert('date click! ' + arg.dateStr)
    },

    dateTime() {
      var today = new Date();
      var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
      var time = today.getHours() + ":" + today.getMinutes() ;
      this.time = time
      alert(date);
    }
  }

}

</script>

<style>
.container {
  color: black;
  margin-left:0
}

</style>
