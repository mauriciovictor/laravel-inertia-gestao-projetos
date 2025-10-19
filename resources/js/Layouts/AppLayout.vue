<script setup>
import {ref} from "vue";
import {index as UsersIndex} from "../actions/App/Http/Controllers/UserController.js";
import HomeRender from "../actions/App/Http/Controllers/HomeController.js";
import {useToastValidationsErrors} from "../composables/useToastValidationsErrors.js";
import {useToastFlashMessages} from "../composables/useToastFlashMessages.js";

const toastValidationErrors =  useToastValidationsErrors()
toastValidationErrors.load()

useToastFlashMessages()

const items = ref([
    {
        label: 'Gerenciamento do sistema',
        items: [
            {
                label: 'Usuários',
                icon: 'pi pi-user',
                shortcut: 'CRTL+N',
                action: () =>  UsersIndex()
            },
            {
                label: 'Perfis',
                icon: 'pi pi-key',
                shortcut: 'CRTL+S',
                action: () =>  UsersIndex()
            },
            {
                label: 'projetos',
                icon: 'pi pi-cog',
                shortcut: 'CRTL+O',
                action: () =>  UsersIndex()
            },
        ]
    },
]);
</script>

<template>
    <div class="flex">
        <Toast/>
        <Menu :model="items" class="flex flex-col w-full h-screen md:w-80">
            <template #start>
                <Link :href="HomeRender()" class="flex items-center gap-1 bg-neutral-50 h-[86px] ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64" role="img" aria-labelledby="title2">
                      <title id="title2">Tasks Network Logo</title>
                      <desc>Nodes connected by lines representing task dependencies</desc>
                      <g fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="60" height="60" rx="9" fill="#F7FBFF"/>
                          <!-- connections -->
                        <path d="M20 18 L34 28 L44 18" stroke="#CFE8FF" stroke-width="3"/>
                        <path d="M34 28 L34 42" stroke="#CFE8FF" stroke-width="3"/>
                          <!-- nodes -->
                        <circle cx="20" cy="18" r="5" fill="#0B6FBD"/>
                        <circle cx="34" cy="28" r="6" fill="#066A49"/>
                        <circle cx="44" cy="18" r="4" fill="#F59E0B"/>
                        <circle cx="34" cy="42" r="5" fill="#7C3AED"/>
                          <!-- small accent -->
                        <circle cx="48" cy="46" r="3" fill="#10B981"/>
                      </g>
                    </svg>
                    <span class="text-lg font-semibold">Gestão de projetos</span>
                </Link>
            </template>
            <template #submenulabel="{ item }">
                <span class="text-primary font-bold">{{ item.label }}</span>
            </template>
            <template class="flex-1" #item="{ item, props }" >
                <Link :href="item.action()" class="flex items-center" v-bind="props.action">
                    <span :class="item.icon"/>
                    <span>{{item.label}}</span>

                    <span v-if="item.shortcut"
                          class="ml-auto border border-surface rounded bg-emphasis text-muted-color text-xs p-1">{{
                            item.shortcut
                        }}</span>
                </Link>
            </template>
            <template  #end >
            </template>
        </Menu>
        <div class="flex flex-col w-full ">
            <div class="flex justify-end bg-neutral-50 gap-3 items-center w-full h-[86px] px-5 border border-t-white border-l-white border-r-white border-b-gray-100">
                <button class="border-0 bg-transparent flex items-center p-2 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer transition-colors duration-200">
                    <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" class="mr-2" shape="circle"/>
                    <span class="inline-flex flex-col items-start">
                        <span class="font-bold">Amy Elsner</span>
                    </span>
                </button>
                <a href="#" class="flex items-center hover:text-red-500 transition-colors duration-200">
                    <span class="pi pi-sign-out"/>
                    <span>Logout</span>
                </a>
            </div>
            <div class="flex flex-1 flex-col p-12">
                <slot/>
            </div>
        </div>
    </div>
</template>

