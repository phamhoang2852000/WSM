<template>
<div>
  <label for="inputDivision" class="form-label"> {{this.title}}</label>

  <select  @change="myFunction" class="form-control " :id="this.data">
    <option v-for="value in values" v-bind:key="value.id" :value="value.id" :name="value.id">
        {{ value.name }}
    </option>
  </select>
</div>

</template>

<script>

// const axios = require('axios');
export default {
  props: {
    title: String,
    data: String,
    values: Array,
  },

  data() {
    return {
      selected: ''

    }
  },
  methods: {
    myFunction(event) {
      this.selected = event.target.value;
      // console.log(this.selected);
      this.$emit('change', this.selected);
    },

  }
}
</script>

<style>

</style>
