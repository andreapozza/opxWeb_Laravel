<template>
  <Label v-if="label">{{ label }}</Label>
  <div
    @click="onClick"
    slug-container
    class="flex flex-wrap items-baseline rounded pl-2 bg-gray-50 border border-gray-200">
    <div class="text-gray-500 text-ellipsis whitespace-nowrap overflow-x-hidden lg:max-w-[50%]">
      <slot name="prepend" />
    </div>
    <span class="text-gray-500">/</span>
    <input
      ref="input"
      class="
        appearance-none
        flex-1
        lg:min-w-0
        bg-gray-50
        text-gray-700
        border-0
        py-3
        px-4
        leading-tight
        focus:outline-none focus:bg-white focus:border-gray-500
        pl-0
        max-w-full
      "
      type="text"
      :placeholder="slugify(placeholder)"
      @input="(ev) => $emit('update:value', slugify(ev.target.value))"
      :value="value"
    />
  </div>
</template>

<script>
import { slugify } from '@/utils';
import Label from '@/Shared/Form/Label.vue';

export default {
  components: { Label },
  props: {
    label: String,
    placeholder: String,
    value: String
  },
  emits: ['update:value'],
  setup() {
    const onClick = ev => {
      const container = ev.target.closest('div[slug-container]')
      const input = container.querySelector('input')
      input.focus()
    }
    return {
      slugify,
      onClick
    }
  }
}
</script>