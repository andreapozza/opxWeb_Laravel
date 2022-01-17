<template>
  <h1 @click="counter++">Ciao {{ counter }}</h1>
</template>

<script>
export default {
  data() {
    return {
      counter: 0
    }
  }
}
</script>