<template>
  <div class="fixed inset-0 w-screen h-screen bg-gray-900/75 z-30" @click="clicked" role="backdrop">
    <slot />
  </div>
</template>

<script setup>

const emits = defineEmits(['click'])

const clicked = ev => {
  if(ev.target.getAttribute('role') != 'backdrop') return
  emits('click')
}

</script>