<script setup>
import AppLayout     from "../../../Layouts/AppLayout.vue";
import {router, useForm, Form, Link} from "@inertiajs/vue3";
import ActionCan from "../../../Components/ActionCan.vue";
import {onMounted, reactive, ref} from "vue";
import draggable from "vuedraggable";

import CreateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/CreateCardController.js";
import EditProjectController from "../../../actions/App/Http/Controllers/Projects/EditProjectController.js";
import ListByProjectController from "../../../actions/App/Http/Controllers/Projects/Cards/ListByProjectController.js";
import UpdateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/UpdateCardController.js";
import DeleteCardController from "../../../actions/App/Http/Controllers/Projects/Cards/DeleteCardController.js";
import {useDialogConfirm} from "../../../composables/useDialogConfirm.js";

const props = defineProps(['cards', 'project'])

const dialogConfirm = useDialogConfirm(
    'Confirmação',
    'Deseja o card selecionado?',
    'pi pi-info-circle',
    'Delete',
    'Cancel',
    'pi pi-check',
    'pi pi-times',
    () => {
        router.delete(DeleteCardController({
            project: props.project.id,
            card: selectedRow.value,
        }), {
            preserveState: true, replace: true, preserveScroll: true,
        })
    },
    () => {}
)

const selectedRow = ref(null);

const handleDeleteRecord = (id) => {
    selectedRow.value = id;
    dialogConfirm.showDialog();
}

const op = ref();
const toggle = (event) => {
    op.value.toggle(event);
}

const form = useForm({
    id: null,
    title: '',
    description: '',
})

const handleSuccess = () => {
    form.reset();
    mountCardItems();
    toggle();
}

let cards_items = ref({})

const mountCardItems = () => {
    const cards = {};
    props.cards.forEach(card => {
        cards[`card-${card.id}`] = [
            {name: "Juan", id: 5},
            {name: "Edgard", id: 6},
            {name: "Johnson", id: 7}
        ]
    })
    cards_items.value = cards;
}

const drag = ref(false);

const dragOptions = {
    animation: 200,
    group: "description",
    ghostClass: "ghost",
};

const selectedCard = ref(null);

const handleEditCard = (event, card) => {
    console.log(card)
    selectedCard.value = card;
    form.title = card.title;
    form.description = card.description;

    toggle(event)
}

onMounted(() => {
    mountCardItems();
})
</script>

<template>
    <AppLayout>
        <div class="flex flex-col items-start justify-between">
            <h3 class="text-3xl text-neutral-900 font-medium mb-8">Listagem de cards do projeto: {{project.title}} </h3>
            <ActionCan feature="users" action="create" >
                <Button type="button" label="Novo Card" severity="success" icon="pi pi-plus" class="p-button-outlined" @click="toggle" />
            </ActionCan>
        </div>

        <div class="card flex justify-center">
            <Popover ref="op">
                <Form method="post" @success="handleSuccess" :action="selectedCard.id ? UpdateCardController({
                project: project.id,
                card: selectedCard.id,
                }) : CreateCardController(project.id)" #default="{ errors, resetAndClearErrors }" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Nome</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <InputText name="title" v-model="form.title" placeholder="Digite o nome do card" class="w-full bg-transparent border-0 focus:ring-0"/>
                            </div>
                            <Message v-if="errors.title" severity="error" size="small" variant="simple">{{ errors.title }}</Message>
                        </label>

                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Descrição</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <Textarea v-model="form.description" name="description" rows="5" placeholder="Digite sua descrição" cols="30" class="w-full bg-transparent !border-0 focus:ring-0 focus:outline-none "/>
                            </div>
                            <Message v-if="errors.description" severity="error" size="small" variant="simple">{{ errors.description }}</Message>
                        </label>
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <Button @click="toggle" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
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
            <Card style="overflow: hidden" class="bg-gray-50"  v-for="card in props.cards" :key="card.id" >
                <template #title>
                    <div class="flex justify-between items-center">
                        <p class="m-0 font-bold">
                            {{card.title}}
                        </p>
                        <div class="flex mt-1">
                            <Button type="button" class="p-0" icon="pi pi-pencil" text  @click="(event) => handleEditCard(event, card)"/>
                            <Button type="button" @click="handleDeleteRecord(card.id)"  class="text-red-500 hover:bg-red-100" icon="pi pi-trash" text />
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

                    <draggable
                        v-model="cards_items[`card-${card.id}`]"
                        item-key="order"
                        :component-data="{
                        tag: 'ul',
                        type: 'transition-group',
                        name: !drag ? 'flip-list' : null
                      }"
                        v-bind="dragOptions"
                        @start="drag = true"
                        @end="drag = false"
                        class="space-y-2"
                        group="cards"
                    >
                        <template #item="{ element, index }">
                            <div class="shadow p-3 rounded m-2 bg-white transition-all duration-300 ease-in-out hover:scale-105">{{ element.name }} {{ index }}</div>
                        </template>
                    </draggable>
                </template>
                <template #footer>
                    <div class="flex  gap-2 mt-1">

                    </div>
                </template>
            </Card>
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
