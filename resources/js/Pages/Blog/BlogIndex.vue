<template>
  <Main title="Blog">
    <template #upright>
      <Link
        class="hover:cursor-pointer bg-green-600 hover:bg-green-700 rounded-md px-4 py-2 font-bold shadow text-white text-base inline-flex items-center"
        :href="$page.props.create_link" >
        <font-awesome-icon class="fill-current w-4 h-4 mr-2" :icon="['fas', 'plus']" />
        <span>Nuovo</span>
      </Link>
    </template>
    <Datatable :columns="columns"/>
  </Main>
</template>

<script>
import Main from "@/Shared/Main.vue";
import "datatables.net-dt/css/jquery.dataTables.css";
import { Link } from "@inertiajs/inertia-vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import Datatable from '@/Shared/Datatable/Datatable.vue';

export default {
  components: { Main, Link, FontAwesomeIcon, Datatable },
  data() {
    return {
      columns: [
        {data: 'id', name: 'ID', className: 'dt-body-center', width: '0'},
        {data: 'title', name: 'Titolo'},
        {data: 'author.full_name', name: 'Autore', className: 'dt-body-center'},
        {data: 'page.approved_at', name: 'Approvato il'},
        {
          data: 'action', 
          name: 'Azioni', 
          orderable: false, 
          searchable: false
        },
      ],
    }
  },
};
</script>
