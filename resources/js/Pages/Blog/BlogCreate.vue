<template>
  <Main :title="'Blog -> Crea'">
    <template #upright>
      <Link
        v-if="isEditing"
        as="button"
        class="hover:cursor-pointer bg-green-600 hover:bg-green-700 rounded-md px-4 py-2 font-bold shadow text-white text-base inline-flex items-center"
        :href="$page.props.store_link"
        method="post"
        :data="data" >
        <font-awesome-icon class="fill-current w-4 h-4 mr-2" :icon="['fas', 'save']" />
        <span>Salva</span>
      </Link>
    </template>
    <Form :data="data"/>

    <!-- <pre-custom> {{ data }}</pre-custom> -->
  </Main>
</template>

<script>
import Main from '@/Shared/Main.vue'
import Form from '@/Pages/Blog/BlogForm.vue'
import { Link } from '@inertiajs/inertia-vue3'

const defaultValues = {
  title: '',
  preview: '',
  text: '',
  page: {}
}

export default {
  components: { Main, Form, Link },
  data() {
    return {
      data: JSON.parse(JSON.stringify(defaultValues)),
      isEditing: false
    }
  },
  watch: {
    data:{
      handler(n, o) {
        this.isEditing = JSON.stringify(this.data) != JSON.stringify(defaultValues)
        // console.info(n,o)
      },
      deep: true
    }
  }
}
</script>