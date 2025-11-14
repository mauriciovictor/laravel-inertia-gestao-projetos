import {router, useForm} from '@inertiajs/vue3'
import {useDialogConfirm} from "./useDialogConfirm.js";
import DeleteCardController from "../actions/App/Http/Controllers/Projects/Cards/DeleteCardController.js";
import {nextTick, ref} from "vue";
import ChangeItemPriorityController
    from "../actions/App/Http/Controllers/Projects/Cards/Items/ChangeItemPriorityController.js";
import DeleteCardItemController from "../actions/App/Http/Controllers/Projects/Cards/Items/DeleteCardItemController.js";
import UpdateItemController from "../actions/App/Http/Controllers/Projects/Cards/Items/UpdateItemController.js";
import CreateCardItemController from "../actions/App/Http/Controllers/Projects/Cards/Items/CreateCardItemController.js";
import ChangeCardItemController from "../actions/App/Http/Controllers/Projects/Cards/Items/ChangeCardItemController.js";
export function useProjectCard() {

    const priorities = ref([])
    const cards = ref([])
    const project = ref({})

    const selectedCard = ref(null);

    const dialogDeleteCard = useDialogConfirm(
        'Confirmação',
        'Deseja o card selecionado?',
        'pi pi-info-circle',
        'Delete',
        'Cancel',
        'pi pi-check',
        'pi pi-times',
        () => {
            router.delete(DeleteCardController({
                project: project.value.id,
                card: selectedCard.value,
            }), {
                preserveState: true, replace: true, preserveScroll: true,
            })
        },
        () => {}
    )

    const handleDeleteCard = (id) => {
        selectedCard.value = id;
        dialogDeleteCard.showDialog();
    }


    const popoverFormCard = ref();
    const togglePopoverFormCard = (event) => {
        popoverFormCard.value.toggle(event);
    }


    const formCard = useForm({
        id: null,
        title: '',
        color: '',
        description: '',
    })

    const handleSubmitCardSuccess = (event) => {
        formCard.reset();
        formItem.reset();
        togglePopoverFormCard()
    }

    let cardItems = ref({})
    const mountCardItems = () => {
        const cardsData = {};
        cards.value.forEach(card => {
            cardsData[`card-${card.id}`] = card.items.length > 0 ?
                card.items.map((item, index) => ({name: item.title, description: item.description, priority: item.priority,   id: item.id})) : []
        })
        cardItems.value = cardsData;
    }


    const drag = ref(false);

    const dragOptions = {
        animation: 200,
        group: "description",
        ghostClass: "ghost",
    };


    const handleEditCard = (event, card) => {
        selectedCard.value = card;

        formCard.title = card.title;
        formCard.color = card.color;
        formCard.description = card.description;

        togglePopoverFormCard(event)
    }

   //items
    const formItem = useForm({
        id: null,
        card_id: null,
        title: '',
        description: '',
        priority: '',
    })

    const popoverProjectCardItems = ref();

    const togglePopoverProjectCardItem = async (event, card = null) => {
        if (card) {
            formItem.card_id = card.id;
            selectedCard.value = card;
        }

        await nextTick();

        popoverProjectCardItems.value.toggle(event);
    }

    const handleSubmitItemSuccess = (event) => {
        formCard.reset();
        formItem.reset();
        togglePopoverProjectCardItem()
        mountCardItems();
    }

    const selectedItem = ref(null);
    const menu = ref(null);

     const getPriorityItems = (props) =>
     {
         priorities.value = [];
         props.priorities.map(priority => {
             priorities.value.push({
                 name: priority.name,
                 color: priority.color,
                 label: priority.name,
                 code: priority.code,
                 icon: priority.icon,
                 command: (event) => {
                     const url = ChangeItemPriorityController({
                         card: selectedCard?.value.id,
                         project: project?.value.id,
                     });

                     router.post(url, {
                         _method: 'PUT',
                         item_id: selectedItem.value.id,
                         priority:event.item.code
                     }, {
                         onSuccess: () => mountCardItems()
                     })

                 }
             })
         });
     }


    const onRightClick = (event, card, item) => {
        selectedCard.value = card;
        selectedItem.value = item;
        formItem.id = item.id;

        menu.value.show(event);
    };

    const menuContextItemsToCardItems = ref();

    const mountContextMenuItem = (props) => {
        getPriorityItems(props)
        menuContextItemsToCardItems.value =
            [
            {
                label: 'Prioridade',
                icon: 'pi pi-clock',
                items: [...priorities.value]
            },
                {
                    label: 'Editar',
                    icon: 'pi pi-pencil',
                    command: (e) => {
                        const ev = e?.originalEvent ?? e;
                        if (menu && menu.value && typeof menu.value.hide === 'function') {
                            menu.value.hide();
                        }

                        formItem.title = selectedItem.value.name;
                        formItem.description = selectedItem.value.description;
                        formItem.priority = selectedItem.value.priority;
                        formItem.id = selectedItem.value.id;

                        togglePopoverProjectCardItem(ev, selectedCard.value)
                    }
                },
                {
                    label: 'Excluir',
                    icon: 'pi pi-trash',
                    command: () => handleDeleteCardItem()
                }
            ]
    }

    const onAdd = (event) => {
        const new_card_id = event.to.id.replace('card-item-', '');
        const old_card_id = event.from.id.replace('card-item-', '');
        const item_id = event.item.id.replace('item-', '');
        const url = ChangeCardItemController({
            card: old_card_id,
            project: project?.value.id,
        });

        router.post(url, {
            _method: 'PUT',
            item_id,
            project_card_id: new_card_id
        })
    };

    const getPriority = (element) => priorities.value.find(p => p.code === element.priority)

    const confirmDelete = () => {
        router.delete(DeleteCardItemController({
            project: project.value.id,
            card: selectedCard.value.id,
            item: formItem.id
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

    const updateOrCreateCardItem = () => {
        return formItem?.id ? UpdateItemController({
            project: project?.value.id,
            card: selectedCard?.value.id,
            item: formItem?.id
        }) : CreateCardItemController({
            project: project?.value.id,
            card: selectedCard?.value.id,
        })
    }

    return {
        dialogDeleteCard,
        handleDeleteCard,
        selectedCard,
        popoverFormCard,
        togglePopoverFormCard,
        mountCardItems,
        cardItems,
        drag,
        dragOptions,
        formCard,
        handleEditCard,
        updateOrCreateCardItem,
        handleSubmitItemSuccess,
        formItem,
        togglePopoverProjectCardItem,
        handleSubmitCardSuccess,
        priorities,
        cards,
        project,
        popoverProjectCardItems,
        getPriority,
        onAdd,
        onRightClick,
        menu,
        menuContextItemsToCardItems,
        selectedItem,
        getPriorityItems,
        mountContextMenuItem
    }
}
