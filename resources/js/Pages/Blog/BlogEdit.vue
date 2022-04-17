<template>
  <Main :title="'Blog -> ' + ($page.props.method == 'put' ? 'Modifica -> ' + $page.props.post.title : 'Crea')">
    <Form :data="data" />
    
    <pre-custom class="mt-6">{{ data }}</pre-custom>

    <template v-if="isEditing" #footer>
      <div class="h-full shadow-[0_-20px_25px_-5px_rgb(0,0,0,0.1),0_-8px_10px_-6px_rgb(0,0,0,0.1)] bg-white w-full flex justify-between items-center pl-48">
        <div>
          <!-- left -->
        </div>
        <div>
          <!-- center -->
        </div>
        <div class="px-4">
          <!-- right -->
          <Link
          as="button"
          class="hover:cursor-pointer bg-green-600 hover:bg-green-700 rounded-md px-4 py-2 font-bold shadow text-white text-base inline-flex items-center"
          :href="$page.props.save_link"
          :method="$page.props.method"
          :data="data">
          <font-awesome-icon class="fill-current w-4 h-4 mr-2" :icon="['fas', 'save']" />
          <span>Salva</span>
        </Link>
        </div>
      </div>
    </template>
  </Main>
</template>

<script setup>
import { Link, usePage, useForm } from '@inertiajs/inertia-vue3'
import Main from '@/Components/Main.vue'
import Form from './BlogForm.vue'
import { computed, ref, watch } from 'vue'


const data = ref(JSON.parse(JSON.stringify(usePage().props.value.post)))
const inertiaForm = computed(() => useForm(data.value))
const isEditing = computed(() => JSON.stringify(data.value) != JSON.stringify(usePage().props.value.post))
    
// TODO: invia form da qui?
</script>