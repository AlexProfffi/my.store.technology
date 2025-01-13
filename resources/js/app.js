
// ------ Include modules -------

import '/resources/css/app.css'

import popper from 'popper.js'
//window.Popper = require('popper.js').default;

import $ from "jquery";
// window.$ = window.jQuery = require('jquery');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy';

import PrimeVue from "primevue/config";
import Aura from '@primevue/themes/aura';

import { createPinia } from "pinia";
const pinia = createPinia();



// ------- Inertia --------

const el = document.getElementById('app');

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue, {
                theme: {
                    preset: Aura
                }
            })
            .use(pinia)
            .use(ZiggyVue)
            .mount(el)
    },
})

