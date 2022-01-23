<template>
  <Main :title="'Blog -> ' + ($page.props.method == 'put' ? 'Modifica -> ' + $page.props.post.title : 'Crea')">
    <template #upright>
      <Link
        as="button"
        v-if="isEditing"
        class="hover:cursor-pointer bg-green-600 hover:bg-green-700 rounded-md px-4 py-2 font-bold shadow text-white text-base inline-flex items-center"
        :href="$page.props.save_link"
        :method="$page.props.method"
        :data="data">
        <font-awesome-icon class="fill-current w-4 h-4 mr-2" :icon="['fas', 'save']" />
        <span>Salva</span>
      </Link>
    </template>
    <Form :data="data" />
    <pre-custom class="mt-6">{{ data }}</pre-custom>
  </Main>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Main from '@/Shared/Main.vue'
import Form from './BlogForm.vue'

export default {
  components: { Main, Form, Link },
  data() {
    return {
      data: JSON.parse(JSON.stringify(this.$page.props.post))
    }
  },
  computed: {
    isEditing() {
      return JSON.stringify(this.data) != JSON.stringify(this.$page.props.post)
    }
  },
}
</script>