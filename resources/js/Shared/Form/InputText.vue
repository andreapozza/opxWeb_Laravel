<template>
  <Label v-if="label">
    {{ label }}
  </Label>
  <input
    class="
      appearance-none
      block
      w-full
      bg-gray-50
      text-gray-700
      border
      rounded
      py-3
      px-4
      leading-tight
      focus:outline-none focus:bg-white focus:border-gray-500
    "
    type="text"
    :placeholder="placeholder"
    :class="{ 'border-red-500': !isValid, 'border-gray-200': isValid }"
    :value="value"
    @input="ev => $emit('update:value', ev.target.value)"
  />
  <p v-if="!isValid && errorText" class="text-red-500 text-xs italic">
    {{ errorText }}
  </p>
  <p v-if="hintText" class="text-gray-600 text-xs italic">
    {{ hintText }}
  </p>
</template>

<script>
import Label from "@/Shared/Form/Label.vue";

export default {
  props: {
    label: String,
    placeholder: {
      default: "",
    },
    isValid: {
      default: true,
    },
    value: {
      default: "",
    },
    errorText: String,
    hintText: String,
  },
  emits: ["update:value"],
  components: { Label },
};
</script>