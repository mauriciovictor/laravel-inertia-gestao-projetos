import {usePage} from "@inertiajs/vue3";
import {useToast} from "primevue";
import {watch} from "vue";

export const useToastValidationsErrors = () => {
    const page = usePage()
    const toast = useToast()
    const load = () =>  {
        watch(
            () => page.props.errors,
            (errs) => {
                if (errs && Object.keys(errs).length) {
                    const messages = Object.values(errs).join('\n')
                    toast.add({
                        severity: 'warn',
                        summary: 'Erro de validação',
                        detail: messages,
                        life: 5000
                    })
                }
            },
            { deep: true }
        )
    }
    return {
        load
    }
};
