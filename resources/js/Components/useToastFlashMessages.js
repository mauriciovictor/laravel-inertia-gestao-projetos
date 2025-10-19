import {router, usePage} from "@inertiajs/vue3";
import {useToast} from "primevue";
import {onMounted, onUnmounted, watch} from "vue";

export const useToastFlashMessages = () => {
    const page = usePage();
    const toast = useToast();

    const showFlash = () => {
        const flash = page.props.flash;

        //não existe o erro global caso , seja erro de validação de formulario
        if(Object.keys(page.props.errors).length > 0 ) return;

        if (flash?.success) {
            toast.add({
                severity: "success",
                summary: "Sucesso!",
                detail: flash.success,
                life: 5000,
            });
        } else if (flash?.error) {
            toast.add({
                severity: "error",
                summary: "Erro!",
                detail: flash.error,
                life: 5000,
            });
        }
    };

    onUnmounted(router.on('finish', showFlash))
};
