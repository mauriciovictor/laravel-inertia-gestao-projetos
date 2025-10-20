<script setup>
import {Form, useForm} from "@inertiajs/vue3";
import login from "../../routes/login/index.js";

import { ref } from "vue";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(login.store(), { preserveScroll: true });
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md">
            <div class="bg-white backdrop-blur-sm border border-white/8 rounded-2xl p-8 shadow-xl">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 flex items-center justify-center bg-neutral-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="40" height="40" role="img" aria-labelledby="title2">
                            <title id="title2">Tasks Network Logo</title>
                            <desc>Nodes connected by lines representing task dependencies</desc>
                            <g fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="60" height="60" rx="9" fill="#F7FBFF"/>
                                <path d="M20 18 L34 28 L44 18" stroke="#CFE8FF" stroke-width="3"/>
                                <path d="M34 28 L34 42" stroke="#CFE8FF" stroke-width="3"/>
                                <circle cx="20" cy="18" r="5" fill="#0B6FBD"/>
                                <circle cx="34" cy="28" r="6" fill="#066A49"/>
                                <circle cx="44" cy="18" r="4" fill="#F59E0B"/>
                                <circle cx="34" cy="42" r="5" fill="#7C3AED"/>
                                <circle cx="48" cy="46" r="3" fill="#10B981"/>
                            </g>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-neutral-600 text-lg font-semibold">Acesse sua conta</h1>
                        <p class="text-sm text-neutral-600/60">Bem-vindo de volta — entre para continuar</p>
                    </div>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="text-sm text-neutral-600/70 mb-1 block">E-mail</label>
                        <div class="flex items-center gap-3 bg-gray-100 border border-white/6 rounded-md px-3 py-2">
                            <i class="pi pi-envelope text-neutral-600/70"></i>
                            <input
                                v-model="form.email"
                                name="email"
                                type="email"
                                placeholder="seu@exemplo.com"
                                class="bg-transparent outline-none text-neutral-600 w-full placeholder:text-neutral-600/40"
                                autocomplete="email"
                                required
                            />
                        </div>
                        <p v-if="form.errors.email" class="text-rose-400 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label class="text-sm text-neutral-600/70 mb-1 block">Senha</label>
                        <div class="flex items-center gap-3 bg-gray-100 border border-white/6 rounded-md px-3 py-2">
                            <i class="pi pi-key text-neutral-600/70"></i>
                            <input
                                v-model="form.password"
                                name="password"
                                type="password"
                                placeholder="********"
                                class="bg-transparent outline-none text-neutral-600 w-full placeholder:text-neutral-600/40"
                                autocomplete="current-password"
                                required
                            />
                        </div>
                        <p v-if="form.errors.password" class="text-rose-400 text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full py-3 rounded-md bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium hover:opacity-95 transition disabled:opacity-60"
                        >
                            <span v-if="!form.processing">Entrar</span>
                            <span v-else>Entrando...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--    <div class="flex flex-1 h-screen flex-col gap-4 items-center justify-center bg-black/70">-->
<!--        <Form :action="login.store()" method="post" #default="{ errors }"-->
<!--              class="flex flex-col gap-4 items-center justify-center bg-black/70">-->
<!--            <div class="flex flex-col bg-white py-18 px-6 rounded-lg md:w-1/4 md:min-w-[400px] sm:w-10/12">-->
<!--                <h3 class="text-2xl"> Faça seu login</h3>-->
<!--                <div class="flex flex-col gap-2 mt-4">-->
<!--                    <div class="flex flex-col w-full">-->
<!--                        <IconField class="w-full">-->
<!--                            <InputIcon class="pi pi-envelope"/>-->
<!--                            <InputText placeholder="Digite seu E-mail" name="email" fluid/>-->
<!--                        </IconField>-->
<!--                        <Message v-if="errors['email']" severity="error" size="small" variant="simple">-->
<!--                            {{ errors['email'] }}-->
<!--                        </Message>-->
<!--                    </div>-->
<!--                    <div class="flex flex-col w-full">-->
<!--                        <IconField class="w-full">-->
<!--                            <InputIcon class="pi pi-key"/>-->
<!--                            <InputText placeholder="Digite usua senha" name="password" fluid/>-->
<!--                        </IconField>-->
<!--                        <Message v-if="errors['password']" severity="error" size="small" variant="simple">-->
<!--                            {{ errors['password'] }}-->
<!--                        </Message>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <Button type="submit" class="mt-8" severity="primary" label="Submit" icon="pi pi-check"/>-->
<!--            </div>-->
<!--        </Form>-->
<!--    </div>-->
</template>

<style scoped>

</style>
