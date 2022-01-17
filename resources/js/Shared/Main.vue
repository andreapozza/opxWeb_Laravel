<template>
  <Layout>
    <div class="main-content flex-grow bg-gray-100 mt-36 pt-2 md:mt-20 pb-11 md:pb-0">
      <div class="bg-gray-800">
          <div class="rounded-tl-3xl bg-gradient-to-r from-amber-600 to-yellow-400 px-4 py-2 shadow text-2xl text-white flex justify-between">
              <h3 class="font-bold pr-2 py-1.5 whitespace-nowrap overflow-x-auto">{{ title }}</h3>
              <slot name="upright"/>
          </div>
      </div>
      <div class="flex flex-wrap max-h-[calc(100vh-9.5rem)] overflow-auto h-full">
          <!-- content -->
          <div class="w-full p-4 bg-white">
            <slot/>
          </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from './Layout.vue'
export default {
  components: { Layout },
  props: ['title']
}
</script>
