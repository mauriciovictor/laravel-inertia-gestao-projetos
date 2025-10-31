<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import {Form, useForm} from "@inertiajs/vue3";
import {route} from "ziggy-js";
import UpdateUserController from "../../actions/App/Http/Controllers/Users/UpdateUserController.js";
import StoreUserController from "../../actions/App/Http/Controllers/Users/StoreUserController.js";

const props = defineProps(['user', 'roles'])
//carrega os dados pra atualização
const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    role_id: props.user?.role_id,
    password: '',
    password_confirmation: '',
})

</script>
<template>
    <AppLayout>
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-gray-100">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">Cadastro de Usuário</h3>
                    <p class="text-sm text-gray-500 mt-1">Preencha os dados para criar um novo usuário.</p>
                </div>
            </div>

            <Form :action="user?.id? UpdateUserController(user?.id) : StoreUserController()" :method="user?.id? 'post' : 'post'" #default="{ errors, resetAndClearErrors }" class="space-y-6">
                <input type="hidden" name="_method" :value="user?.id? 'put' : 'post'"/>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-user text-gray-400"></i>
                            <InputText name="name" v-model="form.name" placeholder="Seu nome completo" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.name" severity="error" size="small" variant="simple">{{ errors.name }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">E-mail</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-envelope text-gray-400"></i>
                            <InputText type="email" v-model="form.email" name="email"  placeholder="exemplo@dominio.com" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.email" severity="error" size="small" variant="simple">{{ errors.email }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Senha</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-key text-gray-400"></i>
                            <InputText type="text" name="password" placeholder="Crie uma senha segura" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.password" severity="error" size="small" variant="simple">{{ errors.password }}</Message>
                    </label>
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Confirmação de senha</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-key text-gray-400"></i>
                            <InputText type="text" name="password_confirmation" placeholder="Crie uma senha segura" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.password_confirmation" severity="error" size="small" variant="simple">{{ errors.password_confirmation }}</Message>
                    </label>
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Selecione o perfil</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-key text-gray-400"></i>
                            <Select
                                v-model="form.role_id"
                                name="role_id"
                                :options="roles"
                                filter
                                optionLabel="name"
                                optionValue="code"
                                placeholder="Selecione o perfil"
                                class="w-full bg-transparent border-0"
                            />
                        </div>
                        <Message v-if="errors.role_id" severity="error" size="small" variant="simple">{{ errors.role_id }}</Message>
                    </label>
                    <input type="hidden" name="role_id" :value="form.role_id" />
                </div>

                <div class="flex items-center justify-end gap-3">
                    <Link :href="route('users.index')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
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

