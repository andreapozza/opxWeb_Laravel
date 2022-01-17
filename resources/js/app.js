require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import PreCustom from './Shared/PreCustom.vue';
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
  delay: 250,
  showSpinner: true,
  color: '#f24900'
})

import './font-awesome-icons'

createInertiaApp({
  resolve: name => import(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component("font-awesome-icon", FontAwesomeIcon)
      .component("pre-custom", PreCustom)
      .use(plugin)
      .mount(el)
  },
})