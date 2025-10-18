import 'primeicons/primeicons.css'

import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
import ConfirmationService from "primevue/confirmationservice";
import {Button, DatePicker, InputText, InputIcon, IconField, Message, Toast, Menu, Avatar} from "primevue";

import {ThemeDefault} from "../Themes/primevue/default";
import {Form} from "@primevue/forms";
import Aura from "@primeuix/themes/aura";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import {Link} from "@inertiajs/vue3";
export default function registerPrimeVue(app) {
    app.use(PrimeVue, {
        ripple: true,
        theme: {
            preset: Aura,
            options: {
                darkModeSelector: '.dark',
                cssLayer: {
                    name: 'primevue',
                    order: 'theme, base, primevue'
                }
            }
        }
    });

    app.component('Button', Button)
    app.component('DatePicker', DatePicker)
    app.component('InputText', InputText)
    app.component('Form', Form)
    app.component('IconField', IconField)
    app.component('InputIcon', InputIcon)
    app.component('Link', Link)
    app.component('Message', Message)
    app.component('Toast', Toast)
    app.component('Menu', Menu)
    app.component('Avatar', Avatar)
    app.component('DataTable', DataTable)
    app.component('Column', Column)
    app.component('ColumnGroup', ColumnGroup)
    app.component('Row', Row)

    app.use(ToastService);
    app.use(ConfirmationService);
}

