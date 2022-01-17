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
    <table id="myTable" class="display cell-border nowrap">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titolo</th>
          <th>Autore</th>
          <th>Pubblicato il</th>
          <th>Azioni</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </Main>
</template>

<script>
import Main from "../../Shared/Main.vue";
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/jquery.dataTables.css";
import { Link } from "@inertiajs/inertia-vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Inertia } from '@inertiajs/inertia';

export default {
  components: { Main, Link, FontAwesomeIcon },
  mounted() {
    this.datatableInit();
    let timeout
    window.addEventListener('resize', () => {
      clearTimeout(timeout)
      timeout = setTimeout(async () => {
        await new DataTable("#myTable").destroy()
        this.datatableInit()
      }, 500)
    })
  },
  methods: {
    datatableInit() {
      const isMobile = window.innerWidth < 768
      const table = new DataTable("#myTable", {
        processing: true,
        stateSave: true,
        serverSide: true,
        ajax: this.$page.props.datatable_link,
        scrollY: isMobile ? "calc(100vh - 32rem)" : "calc(100vh - 20rem)",
        scrollCollapse: !isMobile,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tutti"]],
        autoWidth: true,
        ordering: true,
        order: [[0, "desc"]],
        scrollX: isMobile,
        language: {
          ...require('../../i18n/it_it.json')
        },
        columns: [
          {data: 'id', name: 'id', className: 'dt-body-center', width: '0'},
          {data: 'title', name: 'title'},
          {data: 'author.full_name', name: 'author', className: 'dt-body-center'},
          {data: 'page.approved_at', name: 'approved_at'},
          {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false
          },
        ],
        drawCallback: () => {
          this.setInertiaLinks()
        }
      });
    },
    setInertiaLinks() {
      document.querySelectorAll('a.inertia[href]').forEach(link => {
        link.onclick = e => {
          e.preventDefault();
          Inertia.visit(link.href)
        }
      })
    }
  }
};
</script>

<style>
@media (min-width: 768px) {
  .dataTables_scrollHeadInner,
  .dataTables_scrollHeadInner table {
    width: 100%!important;
  }
}

a.action:not(:last-child) {
  margin-right: 1rem;
}
</style>