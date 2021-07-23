<template>
  <div>
    <div v-if="success" class="error text-success">
      <div class="alert alert-success">
        {{ success }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Success',
  props: {
    success: {
      type: String,
      required: true
    }
  }
}
</script>
