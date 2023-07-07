
// ------ Include modules -------

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { ZiggyVue } from 'ziggy';


// ------- Inertia --------

const el = document.getElementById('app');

const app = createApp({

    setup() {
    },

    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .use(InertiaPlugin)
    .use(ZiggyVue)

app.mount(el);
