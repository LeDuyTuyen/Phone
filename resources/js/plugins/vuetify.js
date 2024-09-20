import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

import { aliases, mdi } from "vuetify/iconsets/mdi";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const vuetify = createVuetify({
    icons: {
        defaultSet: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
    theme: {
        themes: {
            light: {
                primary: "#1976D2",
                secondary: "#424242",
                accent: "#82B1FF",
                error: "#FF5252",
                info: "#2196F3",
                success: "#4CAF50",
                warning: "#FFC107",
            },
        },
    },
    components,
    directives,
    ssr: true,
});

export default vuetify;
