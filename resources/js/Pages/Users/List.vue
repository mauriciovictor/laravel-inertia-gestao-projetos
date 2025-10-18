<script setup>
import {useToast} from "primevue";
import AppLayout from '../../Layouts/AppLayout.vue'
import {Form, router} from "@inertiajs/vue3";
import {route} from "ziggy-js";

const props = defineProps({
    users: Array,
})

const toast = useToast()
</script>

<template>
    <AppLayout>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Usuários </h3>
            <Button label="Novo Usuário" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="router.get('/users/create')"/>
        </div>

        <div class="bg-white border border-gray-100 rounded-lg shadow-md w-full p-12">
            <DataTable :value="users" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem"
                       paginatorTemplate="RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
                       currentPageReportTemplate="{first} to {last} of {totalRecords}">
                <template #paginatorstart>
                    <Button type="button" icon="pi pi-refresh" text />
                </template>
                <template #paginatorend>
                    <Button type="button" icon="pi pi-download" text />
                </template>
                <Column field="name" header="Name" style="width: 25%"></Column>
                <Column field="email" header="E-mail" style="width: 25%"></Column>
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


