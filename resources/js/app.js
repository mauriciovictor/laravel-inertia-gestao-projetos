import './bootstrap';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import registerPrimeVue from './plugins/primevue';
import { Link } from '@inertiajs/vue3'
import MenuCan from "./Components/MenuCan.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        return pages[`./Pages/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
        app.use(plugin)
        registerPrimeVue(app)

        app.component('MenuCan', MenuCan)
        app.component('Link', Link)
        app.mount(el)
        return app
    },
})
