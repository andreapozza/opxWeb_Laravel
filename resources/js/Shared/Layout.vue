<template>
  <Head :title="'OPXweb | ' + $page.props.appName" />
  <Nav/>
  <div class="flex flex-col md:flex-row">
    <Sidebar :key="sidebarKey"/>
    <slot/>
  </div>
</template>

<script>

import Nav from './Nav.vue';
import Sidebar from './Sidebar/Sidebar.vue';
import { ref } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
  components: { Nav, Sidebar, Head },
  setup() {
    const sidebarKey = ref(0)
    window.addEventListener('resize', () => {
      sidebarKey.value++
    })

    return { sidebarKey }
  }
}
</script>