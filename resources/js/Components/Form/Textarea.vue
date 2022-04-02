<template>
  <Label v-if="label">{{ label }}</Label>
  <textarea
    :cols="30"
    :rows="5"
    class="
      appearance-none
      block
      w-full
      bg-gray-50
      text-gray-700
      border border-gray-200
      rounded
      py-3
      px-4
      leading-tight
      focus:outline-none focus:bg-white focus:border-gray-500
    "
    :value="value"
    :placeholder="placeholder"
    @input="ev => $mit('update:value', ev.target.value)"
  ></textarea>
</template>

<script>
import Label from '@/Components/Form/Label.vue'
export default {
  components: { Label },
  props: {
    label: String,
    cols: {
      default: 30
    },
    rows: {
      default: 5
    },
    value: String,
    placeholder: String
  },
  emits: ['update:value']
}
</script>