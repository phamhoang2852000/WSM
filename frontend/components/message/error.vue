<template>
  <div>
    <div v-if="error" class="error text-danger">
      <div class="alert alert-danger">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Error',
  props: {
    error: {
      type: String,
      required: true
    }
  }
}
</script>
