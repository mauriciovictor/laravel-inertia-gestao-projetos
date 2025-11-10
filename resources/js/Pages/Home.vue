<script setup>
import AppLayout from '../Layouts/AppLayout.vue'
import draggable from "vuedraggable";
import {reactive, ref} from "vue";
const props= defineProps(['name'])

const list1 =  reactive([
    { name: "John", id: 1 },
    { name: "Joao", id: 2 },
    { name: "Jean", id: 3 },
    { name: "Gerard", id: 4 }
])

const list2 = reactive([
    { name: "Juan", id: 5 },
    { name: "Edgard", id: 6 },
    { name: "Johnson", id: 7 }
])

const drag = ref(false);

const dragOptions = {
    animation: 200,
    group: "description",
    ghostClass: "ghost",
};

</script>

<template>
    <Toast/>
     <AppLayout>
         <h3 class="text-3xl text-neutral-900 font-medium mb-8"> Olá, {{name}} </h3>
         <div class="flex flex-row gap-3 flex-wrap">
             <div class="flex-1 flex gap-2 flex-col">
                 <h3>Draggable 1</h3>
                 <draggable
                     v-model="list1"
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
                     group="people"
                 >
                     <template #item="{ element, index }">
                         <div class="shadow p-3 rounded m-2 bg-white transition-all duration-300 ease-in-out hover:scale-105">{{ element.name }} {{ index }}</div>
                     </template>
                 </draggable>
             </div>

             <div class="flex-1 flex gap-2 flex-col">
                 <h3>Draggable 2</h3>
                 <draggable
                     v-model="list2"
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
                     group="people"
                 >
                     <template #item="{ element, index }">
                         <div class="shadow p-3 m-2 rounded bg-white transition-all duration-300 ease-in-out hover:scale-105">{{ element.name }} {{ index }}</div>
                     </template>
                 </draggable>
             </div>
         </div>
     </AppLayout>
</template>

