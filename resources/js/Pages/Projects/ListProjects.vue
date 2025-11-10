<script setup>
import AppLayout     from "../../Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import ActionCan from "../../Components/ActionCan.vue";

const props = defineProps(['projects'])

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
        <div class="flex flex-row flex-wrap gap-6">
            <Card style="width: 25rem; overflow: hidden"  v-for="project in props.projects.data" :key="project.id" >
                <template #title>{{project.title}}</template>
                <template #subtitle>Card subtitle</template>
                <template #content>
                    <p class="m-0">
                        {{project.description}}
                    </p>
                </template>
                <template #footer>
                    <div class="flex gap-4 mt-1">
                        <Link :href="`/projects/${project.id}`" class="w-full">
                            <Button label="Ver mais" severity="warn"  class="w-full" />
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
