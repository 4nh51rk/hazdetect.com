import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.es";
// import 'flowbite'

const appName =
  window.document.getElementsByTagName('title')[0]?.innerText || 'HazDetect'

let asyncViews = () => {
  return import.meta.glob('./Pages/**/*.vue')
}

createInertiaApp({
  title: (title) => (title != 'Home' ? `${title} - HazDetect` : 'HazDetect'),
  resolve: async (name) => {
    if (import.meta.env.DEV) {
      let page = (await import(`./Pages/${name}.vue`)).default
      return page
    } else {
      let pages = asyncViews()
      const importPage = pages[`./Pages/${name}.vue`]

      return importPage().then((module) => module.default)
    }
  },
  setup({ el, App, props, plugin }) {
    const VueApp = createApp({ render: () => h(App, props) })

    VueApp.config.globalProperties.route = window.route

    VueApp.use(plugin)
      .use(ZiggyVue)
    //   .component('InertiaHead', Head)
    //   .component('InertiaLink', Link)
      .mount(el)
  },
})

InertiaProgress.init({ color: '#4B5563', showSpinner: true, })
import "./bootstrap";
