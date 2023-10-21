require('./bootstrap');
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import PrimeVue from 'primevue/config';
import '../css/app.css';
import 'primevue/resources/themes/bootstrap4-light-blue/theme.css';
// import axios from "axios";
import Tooltip from 'primevue/tooltip';



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - JJChat`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) }).use()
            .use(PrimeVue)
            .directive('tooltip', Tooltip)
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#ffffff' });
