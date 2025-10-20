<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import DefaultDataTable  from "../../Components/ui/DefaultDataTable.vue";
import {ref} from "vue";
import {route} from "ziggy-js";
import {router} from "@inertiajs/vue3";
const props = defineProps({
    perfis: Object,
})
const pageRoute = ref(route('roles.index'))
const pageRouteEdit = ref(route('roles.edit', ':id'))
const routeDelete = ref(route('roles.destroy', ':id'))

const columns = [
    {
        header: 'Nome',
        field: 'name',
        sortable: true,
        filter: true,
        style: 'width: 25%'
    }
]

const filters = ref({
    global: { value: null, matchMode: 'contains' },
    name:{ constraints: [{ value: null, matchMode: 'contains' }] },
});
</script>

<template>
    <AppLayout>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Perfis de Usuários </h3>
            <Button label="Novo Perfil" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="router.get(route('roles.create'))"/>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg shadow-md w-full p-12">
            <DefaultDataTable
                :data="props.perfis"
                :route="pageRoute"
                :route-edit="pageRouteEdit"
                :route-delete="routeDelete"
                :columns="columns"
                :filters="filters"
            />
        </div>
    </AppLayout>
</template>


