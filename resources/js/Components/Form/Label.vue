<template>
  <label
    class="block tracking-wide text-gray-700 text-xs font-bold mb-2"
    :class="{ 'uppercase': uppercase }"
  >
    <slot />
  </label>
</template>

<script>
export default {
  props: {
    uppercase: {
      default: true
    }
  }
}
</script>