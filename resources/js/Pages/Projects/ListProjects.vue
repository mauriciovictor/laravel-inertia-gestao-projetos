<script setup>
import AppLayout     from "../../Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import ActionCan from "../../Components/ActionCan.vue";
import EditProjectController from "../../actions/App/Http/Controllers/Projects/EditProjectController.js";
import {useDialogConfirm} from "../../composables/useDialogConfirm.js";
import {ref} from "vue";
import DeleteProjectController from "../../actions/App/Http/Controllers/Projects/DeleteProjectController.js";
import {route} from "ziggy-js";
import ListByProjectController from "../../actions/App/Http/Controllers/Projects/Cards/ListByProjectController.js";

const props = defineProps(['projects'])

const dialogConfirm = useDialogConfirm(
    'Confirmação',
    'Deseja deletar o registro?',
    'pi pi-info-circle',
    'Delete',
    'Cancel',
    'pi pi-check',
    'pi pi-times',
    () => {
        router.delete(DeleteProjectController(selectedRow.value), {
            preserveState: true, replace: true, preserveScroll: true,
        })
    },
    () => {}
)

const selectedRow = ref(null);

const handleDeleteRecord = (id) => {
    selectedRow.value = id;
    dialogConfirm.showDialog();
}

const handlePage = (event) => {
    router.get('/projects', {
        page: event.page + 1,
        per_page: event.rows
    }, {
        preserveState: true, replace: false, preserveScroll: true
    })
}
</script>

<template>
    <AppLayout>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Projetos </h3>
            <ActionCan feature="users" action="create" >
                <Button label="Novo Projeto" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="router.get('/projects/create')"/>
            </ActionCan>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <Card style="overflow: hidden" class="bg-gray-50"  v-for="project in props.projects.data" :key="project.id" >
                <template #title>{{project.title}}</template>
                <template #subtitle>Card subtitle</template>
                <template #content>
                    <p class="m-0">
                        {{project.description}}
                    </p>
                </template>
                <template #footer>
                    <div class="flex  gap-2 mt-1">
                        <Link :href="EditProjectController(project.id)">
                            <Button type="button" icon="pi pi-pencil" text />
                        </Link>
                        <Button type="button" @click="handleDeleteRecord(project.id)"  class="text-red-500 hover:bg-red-100" icon="pi pi-trash" text />
                        <Link :href="ListByProjectController(project?.id)" class="w-full">
                            <Button label="Ver mais" variant="outlined"  icon="pi pi-arrow-right" severity="warn"  class="w-full" />
                        </Link>
                    </div>
                </template>
            </Card>
        </div>


        <Paginator
            :template="{
        '640px': 'PrevPageLink CurrentPageReport NextPageLink',
        '960px': 'FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink',
        '1300px': 'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink',
        default: 'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink JumpToPageDropdown JumpToPageInput'
    }"
            :rows="projects?.per_page"
            :totalRecords="projects?.total"
            @page="handlePage($event)"
        >
        </Paginator>
    </AppLayout>
</template>

<style scoped>

</style>
