<template>
  <div class="bg-gray-800 shadow-xl h-16 fixed md:relative bottom-0 mt-12 md:mt-0 md:h-screen z-10 w-full overflow-hidden flex-shrink-0"
    :class="{'md:w-48': isSidebarOpen, 'md:w-12': !isSidebarOpen}">

    <div class="md:mt-12 md:w-48 md:absolute md:left-0 md:top-12 content-center md:content-start text-left justify-between">
      <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left overflow-auto max-h-screen"
        :class="{'md:w-14': !isSidebarOpen}">
        <SidebarItem :isSidebarOpen="isSidebarOpen" text="Dashboard" :icon="['fas', 'tachometer-alt']" link="/cms/dashboard" :active="$page.url == '/cms/dashboard'"/>
        <SidebarItem :isSidebarOpen="isSidebarOpen" text="Pagine" :icon="['far', 'file-alt']" link="/cms/pages" :active="$page.url == '/cms/pages'"/>
        <SidebarItem :isSidebarOpen="isSidebarOpen" text="Blog" :icon="['far', 'newspaper']" link="/cms/posts" :active="$page.url.startsWith('/cms/posts')"/>
      </ul>
    </div>

    <div class="hidden md:block absolute hover:cursor-pointer bottom-3 right-0 p-4 text-right text-white text-xl"
      @click="toggleSidebarOpening"
      :title="isSidebarOpen ? 'Contrai' : 'Espandi'">
      <font-awesome-icon :icon="['fas', 'chevron-left']" :rotation="isSidebarOpen ? null : '180'"/>
    </div>
  </div>
</template>

<script>
import SidebarItem from './SidebarItem.vue'

export default {
  components: { SidebarItem },
  data() {
    return {
      isSidebarOpen: localStorage.getItem('sidebarOpen') == '1' ?? false,
    }
  },
  methods: {
    toggleSidebarOpening() {
      this.isSidebarOpen = !this.isSidebarOpen
      localStorage.setItem('sidebarOpen', this.isSidebarOpen ? '1' : '0')
    }
  }
}
</script>