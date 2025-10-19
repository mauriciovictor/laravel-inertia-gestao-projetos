<script setup>
import {useToast} from "primevue";
import AppLayout from '../../Layouts/AppLayout.vue'
import {Form, router} from "@inertiajs/vue3";
import {route} from "ziggy-js";
import {ref, computed} from "vue";
const props = defineProps({
    users: Object,
})


const filters = ref({
    global: { value: null, matchMode: 'contains' },
    name:{ constraints: [{ value: null, matchMode: 'contains' }] },
    email:{ constraints: [{ value: null, matchMode: 'equals' }]},
});

const toast = useToast()

const rowsPerPage = computed(() => props.users?.per_page ?? 5);
const totalRecords = computed(() => props.users?.total ?? (props.users.data?.length ?? 0));
const firstIndex = computed(() => ((props.users.current_page ?? 1) - 1) * (props.users.per_page ?? 5));

console.log(props.users, rowsPerPage.value, totalRecords.value, firstIndex.value)

function onPage(event) {
    const page = event.page + 1;
    router.get(route('users.index'), { page }, { preserveState: true, replace: true });
}

function flattenFilters(filters) {
    const params = {};
    const keys = Object.keys(filters);
    if (keys.length <=0 ) return params;
    for (const key of keys) {
        if(key != 'global') {
            const firstFilter = filters[key].constraints[0];
            if (firstFilter && firstFilter.value != null && firstFilter.value !== '') {
                params[`${key}[value] `] = firstFilter.value;
                params[`${key}[match]`] = firstFilter.matchMode;
            }
        }
    }
    return params;
}

function onFilter({filters}) {
    const params = {
        page: 1,
        ...flattenFilters(filters),
    };
    router.get(route('users.index'), params, { preserveState: true, replace: true });
}

const matchOptions = [
    { label: 'Contém', value: 'contains' },
    { label: 'Começa com', value: 'startsWith' },
    { label: 'Igual', value: 'equals' },
];

</script>

<template>
    <AppLayout>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Usuários </h3>
            <Button label="Novo Usuário" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="router.get('/users/create')"/>
        </div>

        <div class="bg-white border border-gray-100 rounded-lg shadow-md w-full p-12">
            <DataTable :rows="rowsPerPage"
                       :totalRecords="totalRecords"
                       :first="firstIndex"
                       v-model:filters="filters"
                       filterDisplay="menu"
                       :value="users.data"
                       :globalFilterFields="['name']"
                       removableSort
                       paginator
                       lazy
                       @page="onPage"
                       @filter="onFilter"
                       class="p-1"
                       size="small"
                       :rowsPerPageOptions="[5, 10, 20, 50]"
                       tableStyle="min-width: 50rem"
                       currentPageReportTemplate="{first} de {last} para {totalRecords}">
                <template #header>
                    <div class="flex items-center justify-end">
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText  placeholder="Pesquisa geral" />
                        </IconField>
                    </div>
                </template>
                <template #paginatorstart>
                    <Button type="button" icon="pi pi-refresh" text />
                </template>
                <template #paginatorend>
                    <Button type="button" icon="pi pi-download" text />
                </template>
                <Column sortable field="name"  header="Name" style="width: 25%">
                    <template #body="{ data }">
                        {{ data.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <div class="flex gap-2 items-center">
                            <InputText v-model="filterModel.value" type="text" placeholder="Pesquise por nome" />
                        </div>
                    </template>
                </Column>
                <Column sortable field="email" header="E-mail" style="width: 25%">
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Pesquise por e-mail" />
                    </template>
                </Column>
                <Column header="Ações" style="width: 25%">
                    <template #body="{ data }">
                        <Link :href="route('users.edit', data.id)">
                            <Button type="button" icon="pi pi-pencil" text />
                        </Link>
                    </template>
                </Column>
            </DataTable>
        </div>

<!--        <div class="flex flex-1 flex-col gap-4 items-center justify-center bg-black/70">-->
<!--            <Form :action="store()" method="post" #default="{ errors }"-->
<!--                  class="flex flex-col gap-4 items-center justify-center bg-black/70">-->
<!--                <div class="flex flex-col bg-white py-18 px-6 rounded-lg md:w-1/4 md:min-w-[400px] sm:w-10/12">-->
<!--                    <h3 class="text-2xl"> Faça seu login</h3>-->
<!--                    <div class="flex flex-col gap-2 mt-4">-->
<!--                        <div class="flex flex-col w-full">-->
<!--                            <IconField class="w-full">-->
<!--                                <InputIcon class="pi pi-user"/>-->
<!--                                <InputText placeholder="Search" name="name" fluid/>-->
<!--                            </IconField>-->
<!--                            <Message v-if="errors['name']" severity="error" size="small" variant="simple">-->
<!--                                {{ errors['name'] }}-->
<!--                            </Message>-->
<!--                        </div>-->
<!--                        <div class="flex flex-col w-full">-->
<!--                            <IconField class="w-full">-->
<!--                                <InputIcon class="pi pi-envelope"/>-->
<!--                                <InputText placeholder="Email" name="email" fluid/>-->
<!--                            </IconField>-->
<!--                            <Message v-if="errors['email']" severity="error" size="small" variant="simple">-->
<!--                                {{ errors['email'] }}-->
<!--                            </Message>-->
<!--                        </div>-->
<!--                        <div class="flex flex-col w-full">-->
<!--                            <IconField class="w-full">-->
<!--                                <InputIcon class="pi pi-key"/>-->
<!--                                <InputText placeholder="Search" name="password" fluid/>-->
<!--                            </IconField>-->
<!--                            <Message v-if="errors['password']" severity="error" size="small" variant="simple">-->
<!--                                {{ errors['password'] }}-->
<!--                            </Message>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <Button type="submit" class="mt-8" severity="primary" label="Submit" icon="pi pi-check"/>-->
<!--                </div>-->
<!--            </Form>-->
<!--        </div>-->
    </AppLayout>
</template>


