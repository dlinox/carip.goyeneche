import './bootstrap';
//import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { QuillEditor } from "@vueup/vue-quill";

import vuetify from "@/plugins/vuetify";

import "@vueup/vue-quill/dist/vue-quill.snow.css";
import "vue-advanced-cropper/dist/style.css";

createInertiaApp({

    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("QuillEditor", QuillEditor)
            .use(plugin)
            .use(vuetify)
            .mount(el);
    },
});
