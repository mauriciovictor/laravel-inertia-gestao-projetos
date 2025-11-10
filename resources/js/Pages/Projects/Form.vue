<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import {route} from "ziggy-js";
import UpdateProjectController from "../../actions/App/Http/Controllers/Projects/UpdateProjectController.js";
import StoreProjectController from "../../actions/App/Http/Controllers/Projects/StoreProjectController.js";
import {Form, useForm} from "@inertiajs/vue3";
const props = defineProps(['project', 'status'])

const form = useForm({
    title: props.project?.title,
    description: props.project?.description,
    status: props.project?.status,
});

</script>

<template>
    <AppLayout>
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-gray-100">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">Cadastro de projeto</h3>
                    <p class="text-sm text-gray-500 mt-1">Preencha os dados para criar um novo projetop.</p>
                </div>
            </div>

            <Form :action="project?.id? UpdateProjectController(project?.id) : StoreProjectController()" :method="project?.id? 'post' : 'post'" #default="{ errors, resetAndClearErrors }" class="space-y-6">
                <input type="hidden" name="_method" :value="project?.id? 'put' : 'post'"/>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <InputText name="title" v-model="form.title" placeholder="Título do projeto" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.title" severity="error" size="small" variant="simple">{{ errors.title }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Descrição</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <InputText type="text"  v-model="form.description" name="description"  placeholder="Descrição do seu projeto" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.description" severity="error" size="small" variant="simple">{{ errors.description }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Selecione o perfil</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <Select
                                v-model="form.status"
                                name="role_id"
                                :options="status"
                                filter
                                optionLabel="name"
                                optionValue="code"
                                placeholder="Selecione o perfil"
                                class="w-full bg-transparent border-0"
                            />
                        </div>
                        <Message v-if="errors.status" severity="error" size="small" variant="simple">{{ errors.status }}</Message>
                    </label>
                    <input type="hidden" name="status" :value="form.status" />
                </div>

                <div class="flex items-center justify-end gap-3">
                    <Link :href="route('projects.index')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
                        <i class="pi pi-chevron-left"></i>
                        Voltar
                    </Link>

                    <Button
                        type="submit"
                        class="inline-flex items-center gap-3 px-5 py-3 rounded-lg text-white shadow-md transform hover:-translate-y-0.5 transition"
                        style="background: linear-gradient(90deg,#10b981,#06b6d4);"
                        icon="pi pi-check"
                        label="Salvar"
                    />
                </div>
            </Form>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
