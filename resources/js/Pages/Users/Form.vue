<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import {Form, useForm} from "@inertiajs/vue3";
import {store, update} from "../../actions/App/Http/Controllers/UserController.js";
import {route} from "ziggy-js";
const props = defineProps(['user'])

//carrega os dados pra atualização
const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
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

            <Form :action="user?.id? update(user?.id) : store()" :method="user?.id? 'put' : 'post'" #default="{ errors, resetAndClearErrors }" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-user text-gray-400"></i>
                            <InputText name="name" v-model="form.name" placeholder="Seu nome completo" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.name" severity="error" size="small" variant="simple">{{ errors.name }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">E-mail</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-envelope text-gray-400"></i>
                            <InputText type="email" v-model="form.email" name="email"  placeholder="exemplo@dominio.com" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.email" severity="error" size="small" variant="simple">{{ errors.email }}</Message>
                    </label>

                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Senha</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-key text-gray-400"></i>
                            <InputText type="text" name="password" placeholder="Crie uma senha segura" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.password" severity="error" size="small" variant="simple">{{ errors.password }}</Message>
                    </label>
                    <label class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700 mb-2">Confirmação de senha</span>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                            <i class="pi pi-key text-gray-400"></i>
                            <InputText type="text" name="password_confirmation" placeholder="Crie uma senha segura" class="w-full bg-transparent border-0 focus:ring-0"/>
                        </div>
                        <Message v-if="errors.password_confirmation" severity="error" size="small" variant="simple">{{ errors.password_confirmation }}</Message>
                    </label>
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

