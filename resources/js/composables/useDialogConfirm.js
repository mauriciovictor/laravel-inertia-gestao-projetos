import {useConfirm} from "primevue/useconfirm";

export function useDialogConfirm(header,message, icon, acceptLabel, rejectLabel, acceptIcon, rejectIcon, acceptCallback, rejectCallback) {

    const dialog = useConfirm();

    const  showDialog = () => {
        dialog.require({
            message,
            header,
            icon,
            rejectProps: {
                label: rejectLabel,
                severity: 'secondary',
                outlined: true
            },
            acceptProps: {
                label: acceptLabel,
                severity: 'danger',
            },
            accept: async () => {
                await acceptCallback()
            },
            reject: async () => {
                await rejectCallback()
            }
        });
    }

    return {showDialog, dialog}
}
