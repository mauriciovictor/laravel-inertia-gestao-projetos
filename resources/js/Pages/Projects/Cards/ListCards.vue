<script setup>
import AppLayout     from "../../../Layouts/AppLayout.vue";
import {router, useForm, Form, Link} from "@inertiajs/vue3";
import ActionCan from "../../../Components/ActionCan.vue";
import {onMounted, ref, nextTick} from "vue";
import draggable from "vuedraggable";

import CreateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/CreateCardController.js";
import UpdateCardController from "../../../actions/App/Http/Controllers/Projects/Cards/UpdateCardController.js";
import DeleteCardController from "../../../actions/App/Http/Controllers/Projects/Cards/DeleteCardController.js";
import {useDialogConfirm} from "../../../composables/useDialogConfirm.js";
import CreateCardItemController
    from "../../../actions/App/Http/Controllers/Projects/Cards/Items/CreateCardItemController.js";
import {useToast} from "primevue";
import ChangeItemPriorityController
    from "../../../actions/App/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.js";
import DeleteCardItemController
    from "../../../actions/App/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.js";

const props = defineProps(['cards', 'project', 'priorities'])
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
    color: '',
    description: '',
})

const handleSuccess = (event) => {
    form.reset();
    formItem.reset();
    toggle()
    mountCardItems();
}

let cards_items = ref({})

const mountCardItems = () => {
    const cards = {};
    props.cards.forEach(card => {
        cards[`card-${card.id}`] = card.items.length > 0 ?
            card.items.map((item, index) => ({name: item.title, description: item.description, priority: item.priority,   id: item.id})) : []
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
    selectedCard.value = card;
    form.title = card.title;
    form.color = card.color;
    form.description = card.description;

    toggle(event)
}

onMounted(() => {
    mountCardItems();
})

function hexToRgba(hex, alpha = 1) {
    const r = parseInt(hex.slice(0, 2), 16);
    const g = parseInt(hex.slice(2, 4), 16);
    const b = parseInt(hex.slice(4, 6), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}


//card items
const formItem = useForm({
    id: null,
    card_id: null,
    title: '',
    description: '',
    priority: '',
})

const opItem = ref();

const toggleItem = async (event, card_id = null) => {
    formItem.card_id = card_id;
    await nextTick();
    opItem.value.toggle(event);
}


const handleItemSuccess = (event) => {
    form.reset();
    formItem.reset();
    toggleItem()
    mountCardItems();
}
const toast = useToast();
const selectedItem = ref(null);
const menu = ref(null);

const priorityOptions = props.priorities.map(priority => ({label: priority.name, code: priority.code, icon: priority.icon, command: (event) => {
        const url = ChangeItemPriorityController({
            card: selectedRow.value,
            project: props.project.id,
        });
        router.put(url, {
            item_id: selectedItem.value,
            priority:event.item.code
        }, {
            onSuccess: () => mountCardItems()
        })
    }}));
const selecteItemData = ref(null);
const onRightClick = (event, card, user) => {
    selectedRow.value = card.id;
    selectedItem.value = user.id;
    selecteItemData.value = user;

    menu.value.show(event);
};

const items = ref([
    {
        label: 'Prioridade',
        icon: 'pi pi-clock',
        items: [...priorityOptions]
    },
    {
        label: 'Editar',
        icon: 'pi pi-pencil',
        command: (e) => {
            const ev = e?.originalEvent ?? e;
            if (menu && menu.value && typeof menu.value.hide === 'function') {
                menu.value.hide();
            }

            formItem.title = selecteItemData.value.name;
            formItem.description = selecteItemData.value.description;
            formItem.priority = selecteItemData.value.priority;
            formItem.id = selecteItemData.value.id;
            
            toggleItem(ev, selectedRow.value)
        }
    },
    {
        label: 'Excluir',
        icon: 'pi pi-trash',
        command: () => handleDeleteCardItem()
    }
]);

const onAdd = (event) => {
    const new_card_id = event.to.id.replace('card-item-', '');
    const old_card_id = event.from.id.replace('card-item-', '');
    const item_id = event.item.id.replace('item-', '');
    const url = ChangeCardItemController({
        card: old_card_id,
        project: props.project.id,
    });
    router.put(url, {
        item_id,
        project_card_id: new_card_id
    })
};

const getPriority = (element) => props.priorities.find(p => p.code === element.priority)

const confirmDelete = () => {
    router.delete(DeleteCardItemController({
        project: props.project.id,
        card: selectedRow.value,
        item: selectedItem.value,
    }), {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: () => {
            mountCardItems()
        }
    })
}

const dialogDeleteConfirmItem = useDialogConfirm(
    'Confirmação',
    'Deseja delete o item selecionado?',
    'pi pi-info-circle',
    'Delete',
    'Cancel',
    'pi pi-check',
    'pi pi-times',
    confirmDelete,
    () => {}
)

const handleDeleteCardItem = () => {
    dialogDeleteConfirmItem.showDialog();
}
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
                <Form method="post" @success="handleSuccess" :action="selectedCard?.id ? UpdateCardController({
                project: project?.id,
                card: selectedCard?.id,
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
                        <label class="flex flex-col">
                            <span class="text-sm font-medium text-gray-700 mb-2">Cor</span>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3  border p-1 border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
                                <ColorPicker v-model="form.color" name="color" class="w-full" inputId="card-color"  />
                                <input type="hidden" name="color" :value="form.color" />
                            </div>
                            <Message v-if="errors.color" severity="error" size="small" variant="simple">{{ errors.color }}</Message>
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

        <div class="card flex justify-center">
            <Popover ref="opItem">
                <Form method="post" :action="CreateCardItemController({
                project: project?.id,
                card: formItem?.card_id,
                })"  #default="{ errors, resetAndClearErrors }" class="space-y-6" @success="handleItemSuccess">
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
            <Card  :style="{ backgroundColor: hexToRgba(`${card.color}`, 0.3) }" v-for="card in props.cards" :key="card.id" >
                <template #title>
                    <div class="flex justify-between items-center">
                        <p class="m-0 font-bold">
                            {{card.title}}
                        </p>
                        <div class="flex mt-1">
                            <Button type="button" class="p-0" icon="pi pi-plus" text  @click=" (event) => toggleItem(event, card.id)"/>
                            <Button type="button" severity="warn" class="p-0" icon="pi pi-pencil" text  @click="(event) => handleEditCard(event, card)"/>
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
                        :id="'card-item-' + card.id"
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
                </template>
                <template #footer>
                    <div class="flex  gap-2 mt-1">

                    </div>
                </template>
            </Card>
            <ContextMenu ref="menu" :model="items" @hide="selectedUser = null" />
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
