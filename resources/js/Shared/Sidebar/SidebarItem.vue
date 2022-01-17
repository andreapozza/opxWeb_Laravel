<template>
  <li class="mr-3 flex-1">
    <Link :href="link"
      class="block py-1 md:py-3 pl-1 align-middle no-underline  border-b-2 border-gray-800"
      :class="active ? 'text-white hover:text-white border-amber-500' : 'hover:text-gray-200 text-gray-400'">
      <font-awesome-icon :icon="icon" class="mr-3"/>
      <span v-if="isMobile || isSidebarOpen" class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block">{{ text }}</span>
    </Link>
  </li>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3"
export default {
  components: { Link },
  props: {
    text: {
      default: "Undefined"
    },
    link: {
      default: "#"
    },
    icon: {
      default: 'circle'
    },
    active: {
      default: false
    },
    isSidebarOpen: {
      default: true
    }
  },
  data() {
    return {
      isMobile: window.innerWidth < 768
    }
  }
}
</script>