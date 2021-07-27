
<template>
<div>
  <label for="inputZip" class="form-label">{{this.title}}</label>
   <p>{{selected }}</p>
  <div id="permission">
    <div v-for="value in values" :key="value">
      <input @change="myFunction"  type="checkbox"  :value="value.id" :id="value.name" v-model="selected" >
      <label :for="value.name" >{{value.name}}</label><br>
      <br>
    </div>
  </div>
</div>
</template>

<script>

export default {
  props: {
    title: String,
    values: Array,
  },
  data() {
    return {
      selected: [],
    }
  },
  methods: {
    myFunction(event) {
      // this.selected.push(event.target.value);
      // console.log(this.selected);
      this.$emit('change', this.selected);

    },

  }
}
</script>

<style>
#permission {
  margin-top:20px;
  width:400px;
  height:200px;
  overflow-x:hidden;
  overflow-y:auto;
  border: 1px solid black;
}
</style>
