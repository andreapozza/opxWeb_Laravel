<template>
  <table :id="tableId" class="display">
    <thead>
      <tr>
        <th v-for="(col, i) of columns" :key="i">{{col.name}}</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</template>

<script>
import { defineComponent } from 'vue'
import DataTable from "datatables.net-dt";
import "datatables.net-dt/css/jquery.dataTables.css";
import { Inertia } from '@inertiajs/inertia';

export default defineComponent({
  props: {
    config: {},
    columns: {
      required: true
    },
  },
  data() {
    return {
      isMobile: window.innerWidth <= 768,
      tableId: 'myTable' + Math.floor(Math.random() * 1000)
    }
  },
  computed: {
    defConfig() {
      return({
        processing: true,
        stateSave: true,
        serverSide: true,
        ajax: this.$page.url,
        scrollY: this.isMobile ? "calc(100vh - 36rem)" : "calc(100vh - 20rem)",
        scrollCollapse: !this.isMobile,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tutti"]],
        autoWidth: true,
        ordering: true,
        order: [[0, "desc"]],
        scrollX: this.isMobile,
        language: {
          ...require('../../i18n/it_it.json')
        },
        columns: this.columns,
        drawCallback: () => {
          this.setInertiaLinks()
        }
      })
    }
  },
  methods: {
    setInertiaLinks() {
      document.querySelectorAll('.inertia[href]').forEach(link => {
        link.onclick = e => {
          e.preventDefault();
          switch(link.dataset.method) {
            case 'delete':
              Inertia.delete(link.attributes.href.value, {
                onFinish: () => setTimeout(()=>this.datatableDraw(), 100),
                onBefore: () => confirm('Sicuro di cancellare?')
              })
              break;
            case 'get':
            default:
              Inertia.visit(link.attributes.href.value);
              break;
          }
        }
      })
    },

    async datatableRedraw() {
      this.isMobile = window.innerWidth <= 768
      await new DataTable('#'+this.tableId).destroy()
      this.datatableInit()
    },

    datatableInit() {
      const config = Object.assign(this.defConfig, this.config)
      new DataTable('#'+this.tableId, config)
    },

    
  },
  mounted() {
    this.datatableInit()
    let timeout
    window.addEventListener('resize', () => {
      clearTimeout(timeout)
      timeout = setTimeout(() => this.datatableRedraw(), 100)
    })
  }
  
})
</script>

<style lang="scss">
@media (min-width: 768px) {
  .dataTables_scrollHeadInner,
  .dataTables_scrollHeadInner table {
    width: 100%!important;
  }
}

a.action, button.action {
  font-size: 18px;
  color: rgb(180, 180, 180);
  &:hover {
    color: rgb(100, 100, 100);
  }
  &:not(:last-child) {
    margin-right: 1rem;
  }
}
</style>