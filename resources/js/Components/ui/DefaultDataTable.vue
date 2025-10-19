<script setup>
import {router} from "@inertiajs/vue3";
import {ref, computed, watch} from "vue";
import debounce from 'lodash.debounce';

const props = defineProps({
    data: Object,
    columns: Array,
    route: String,
    routeEdit: String,
    filters: Object
})

const filters = ref({
    global: { value: null, matchMode: 'contains' },
});

filters.value = {
    ...filters.value,
    ...props.filters,
}

const sortField = ref(null);
const sortOrder = ref(null);
const rowsPerPage = computed(() => props.data.data?.per_page ?? 5);
const totalRecords = computed(() => props.data.total ?? (props.data.data?.length ?? 0));
const firstIndex = computed(() => ((props.data?.current_page ?? 1) - 1) * (props.data?.per_page ?? 5));

const buildParams = (overrides = {}) => {
    return {
        page: overrides.page ?? 1,
        ...(sortField.value ? { column: sortField.value } : {}),
        ...(sortOrder.value ? { order: sortOrder.value } : {}),
        ...flattenFilters(filters.value),
        ...overrides,
    };
}

function applyRequest(params = {}) {
    const final = buildParams(params);
    // remove nulos
    Object.keys(final).forEach(k => final[k] == null && delete final[k]);
    router.get(props.route, final, { preserveState: true, replace: true });
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
        }else if(filters.global.value != null && filters.global.value !== ''){
            params['search'] = filters.global.value;
        }
    }
    return params;
}

function onPage(event) {
    const page = event.page + 1;
    applyRequest({ page });
}

function onFilter(event) {
    filters.value = event.filters;
    applyRequest({ page: 1 });
}

function onSort(props) {
    sortField.value = props.sortField ?? null;
    sortOrder.value = props.sortOrder == 1 ? 'asc' : (props.sortOrder == -1 ? 'desc' : null);
    applyRequest({ page: 1 });
}
const handleFilterChange = debounce((newValue) => {
    applyRequest({ page: 1 });
}, 500); // 500ms de atraso


watch(
    () => filters.value.global.value,
    (newValue) => {
        handleFilterChange(newValue);
    }
);
</script>

<template>
    <DataTable :rows="rowsPerPage"
               :totalRecords="totalRecords"
               :first="firstIndex"
               v-model:filters="filters"
               filterDisplay="menu"
               :value="data.data"
               :globalFilterFields="['name']"
               removableSort
               paginator
               lazy
               @page="onPage"
               @filter="onFilter"
               @sort="onSort"
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
                    <InputText v-model="filters.global.value" placeholder="Pesquisa geral" />
                </IconField>
            </div>
        </template>
        <template #paginatorstart>
            <Button type="button" icon="pi pi-refresh" text />
        </template>
        <template #paginatorend>
            <Button type="button" icon="pi pi-download" text />
        </template>
        <Column v-for="column in columns" :field="column.field" :header="column.header" :sortable="column.sortable" :style="column.style" >
            <template #body="{ data }">
                {{ data[column.field] }}
            </template>
            <template #filter="{ filterModel }">
                <div class="flex gap-2 items-center">
                    <InputText v-model="filterModel.value" type="text" placeholder="Pesquise por nome" />
                </div>
            </template>
        </Column>

        <Column header="Ações" style="width: 25%">
            <template #body="{ data }">
                <Link :href="props.routeEdit.replace(':id', data.id)">
                    <Button type="button" icon="pi pi-pencil" text />
                </Link>
            </template>
        </Column>
    </DataTable>
</template>

<style scoped>
</style>
