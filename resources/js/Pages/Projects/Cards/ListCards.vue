<script setup>
import AppLayout     from "../../../Layouts/AppLayout.vue";
import {Form} from "@inertiajs/vue3";
import ActionCan from "../../../Components/ActionCan.vue";
import draggable from "vuedraggable";
import CreateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/CreateCardController.js";
import UpdateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/UpdateCardController.js";
import {useProjectCard} from "../../../composables/useProjectCard.js";
import {watch} from "vue";

const props = defineProps(['cards', 'project', 'priorities'])

const {
    selectedCard,
    formCard,
    handleEditCard,
    togglePopoverFormCard,
    dragOptions,
    drag,
    mountCardItems,
    handleDeleteCard,
    cardItems,
    dialogDeleteCard,
    popoverFormCard,
    updateOrCreateCardItem,
    formItem,
    togglePopoverProjectCardItem,
    handleSubmitCardSuccess,
    cards,
    priorities,
    project,
    popoverProjectCardItems,
    onRightClick,
    getPriority,
    onAdd,
    menu,
    menuContextItemsToCardItems,
    selectedItem,
    handleSubmitItemSuccess,
    getPriorityItems,
    mountContextMenuItem
} = useProjectCard()

function hexToRgba(hex, alpha = 1) {
    const r = parseInt(hex.slice(0, 2), 16);
    const g = parseInt(hex.slice(2, 4), 16);
    const b = parseInt(hex.slice(4, 6), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

cards.value = props.cards
project.value = props.project
mountContextMenuItem(props)

mountCardItems()

watch(
    () => props.cards,
    (newVal, oldVal) => {
        cards.value = newVal
        mountCardItems()
    },
    { deep: true }
)
</script>

<template>
    <AppLayout>
        <div class="flex flex-col items-start justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Listagem de cards do projeto: {{props.project.title}} </h3>
            <ActionCan feature="project_cards" action="create" >
                <Button type="button" label="Novo Card" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="togglePopoverFormCard" />
            </ActionCan>
        </div>

        <div class="card flex justify-center">
            <Popover ref="popoverFormCard">
                <Form method="post" @success="handleSubmitCardSuccess" :action="selectedCard?.id ? UpdateCardController({
                project: project?.id,
                card: selectedCard?.id,
                }) : CreateCardController(project.id)" #default="{ errors, resetAndClearErrors }" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <InputText name="title" v-model="formCard.title" placeholder="Digite o nome do card" class="w-full bg-transparent border-0 focus:ring-0"/>
                            </div>
                            <Message v-if="errors.title" severity="error" size="small" variant="simple">{{ errors.title }}</Message>
                        </label>

                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Descrição</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <Textarea v-model="formCard.description" name="description" rows="5" placeholder="Digite sua descrição" cols="30" class="w-full bg-transparent !border-0 focus:ring-0 focus:outline-none "/>
                            </div>
                            <Message v-if="errors.description" severity="error" size="small" variant="simple">{{ errors.description }}</Message>
                        </label>
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Cor</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <ColorPicker v-model="formCard.color" name="color" class="w-full" inputId="card-color"  />
                                <input type="hidden" name="color" :value="formCard.color" />
                            </div>
                            <Message v-if="errors.color" severity="error" size="small" variant="simple">{{ errors.color }}</Message>
                        </label>
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <Button @click="togglePopoverFormCard" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
                            <i class="pi pi-times"></i>
                            Cancelar
                        </Button>

                        <Button
                            type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white shadow-md transform hover:-translate-y-0.5 transition"
                            style="background: linear-gradient(90deg,#10b981,#06b6d4);"
                            icon="pi pi-check"
                            label="Salvar"
                        />
                    </div>
                </Form>
            </Popover>
        </div>

        <div class="card flex justify-center">
            <Popover ref="popoverProjectCardItems">
                <Form method="post" :action="updateOrCreateCardItem()"  #default="{ errors, resetAndClearErrors }" class="space-y-6" @success="handleSubmitItemSuccess">
                    <input type="hidden" name="card_id" :value="formItem?.card_id" />
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <InputText name="title" v-model="formItem.title" placeholder="Digite o nome do item" class="w-full bg-transparent border-0 focus:ring-0"/>
                            </div>
                            <Message v-if="errors.title" severity="error" size="small" variant="simple">{{ errors.title }}</Message>
                        </label>

                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Descrição</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <Textarea v-model="formItem.description" name="description" rows="5" placeholder="Digite sua descrição" cols="30" class="w-full bg-transparent !border-0 focus:ring-0 focus:outline-none "/>
                            </div>
                            <Message v-if="errors.description" severity="error" size="small" variant="simple">{{ errors.description }}</Message>
                        </label>
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Prioridade</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <Select
                                    v-model="formItem.priority"
                                    name="priority"
                                    :options="priorities"
                                    optionLabel="name"
                                    optionValue="code"
                                    placeholder="Selecione a prioridade"
                                    class="w-full bg-transparent border-0"
                                />
                                <input type="hidden" name="priority" :value="formItem.priority" />
                            </div>
                            <Message v-if="errors.priority" severity="error" size="small" variant="simple">{{ errors.priority }}</Message>
                        </label>
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <Button @click="(event) => togglePopoverProjectCardItem(event, null)" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
                            <i class="pi pi-times"></i>
                            Cancelar
                        </Button>

                        <Button
                            type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white shadow-md transform hover:-translate-y-0.5 transition"
                            style="background: linear-gradient(90deg,#10b981,#06b6d4);"
                            icon="pi pi-check"
                            label="Salvar"
                        />
                    </div>
                </Form>
            </Popover>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-6">
            <Card  :style="{ backgroundColor: hexToRgba(`${card.color}`, 0.3) }" v-for="card in props.cards" :key="card.id" >
                <template #title>
                    <div class="flex justify-between items-center">
                        <p class="m-0 font-bold">
                            {{card.title}}
                        </p>
                        <div class="flex mt-1">
                            <ActionCan feature="project_card_items" action="create" >
                                <Button type="button" class="p-0" icon="pi pi-plus" text  @click=" (event) => togglePopoverProjectCardItem(event, card)"/>
                            </ActionCan>

                            <ActionCan feature="project_cards" action="edit" >
                                <Button type="button" severity="warn" class="p-0" icon="pi pi-pencil" text  @click="(event) => handleEditCard(event, card)"/>
                            </ActionCan>

                            <ActionCan feature="project_cards" action="delete" >
                                <Button type="button" @click="handleDeleteCard(card.id)"  class="text-red-500 hover:bg-red-100" icon="pi pi-trash" text />
                            </ActionCan>
                        </div>
                    </div>

                </template>
                <template #subtitle>
                    <p class="m-0 text-sm">
                    Descrição
                    </p>
                </template>
                <template #content>
                    <p class="m-0 text-sm">
                        {{card.description}}
                    </p>
                    <ActionCan feature="project_card_items" action="view" >
                        <draggable
                            :id="'card-item-' + card.id"
                            v-model="cardItems[`card-${card.id}`]"
                            item-key="order"
                            :component-data="{
                        tag: 'ul',
                        type: 'transition-group',
                        name: !drag ? 'flip-list' : null
                      }"
                            v-bind="dragOptions"
                            @start="drag = true"
                            @end="drag = false"
                            class="space-y-2 p-0"
                            @add="onAdd"
                            group="cards"
                        >
                            <template #item="{ element, index }">
                                <div @contextmenu="onRightClick($event, card, element)" :id="'item-'+element.id"  class="shadow p-3 flex justify-between rounded mt-3  transition-all duration-300 ease-in-out hover:scale-105"  :style="{ backgroundColor: `#${card.color}`}">
                                    <strong>
                                        {{ element.name }}
                                    </strong>
                                    <div :class="'p-1 px-3 items-center rounded flex gap-2 text-sm ' + getPriority(element).color " >
                                        <i  :class=" 'text-[10px] '+ getPriority(element).icon"></i>
                                        {{ getPriority(element).name }}
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </ActionCan>

                </template>
                <template #footer>
                    <div class="flex  gap-2 mt-1">

                    </div>
                </template>
            </Card>
            <ContextMenu ref="menu" :model="menuContextItemsToCardItems" @hide="selectedItem = null" />
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
