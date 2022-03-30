<template>
  <Backdrop @click="backdropClicked" 
    class="flex justify-center overflow-y-auto"
    :class="[centered ? 'items-center' : 'items-start']">
    <div class="container md:max-w-2xl rounded-lg shadow-lg border overflow-hidden p-4 bg-white my-12">
      <slot />
    </div>
  </Backdrop>
</template>

<script setup>
import Backdrop from '@/Shared/Backdrop.vue';
import{ ref } from 'vue';

const props = defineProps({
  closeOnBackdropClick: {
    type: Boolean,
    default: true
  },
  centered: {
    type: Boolean,
    default: false
  },
  streched: {
    type: Boolean,
    default: false
  }
})

const emits = defineEmits(['closing'])

const closeModal = () => {
  emits('closing')
}

const backdropClicked = (ev) => {
  if(!props.closeOnBackdropClick) return
  closeModal()
}

</script>
