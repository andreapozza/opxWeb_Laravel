require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import PreCustom from './Components/PreCustom.vue';
import { InertiaProgress } from '@inertiajs/progress'
import Layout from '@/Components/Layout.vue'

InertiaProgress.init({
  delay: 250,
  showSpinner: true,
  color: '#f24900'
})

import './font-awesome-icons'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: title => `${title} | ${appName}`,
    resolve: name => {
        const page = require(`./Pages/${name}.vue`).default
        if(!name.startsWith('Auth/')) {
            page.layout = page.layout || Layout
        }
        return page
      },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .component("font-awesome-icon", FontAwesomeIcon)
        .component("pre-custom", PreCustom)
        .mixin(require('./translation'))
        .use(plugin)
        .mixin({ methods: { route } })
        .mount(el)
    },
})
