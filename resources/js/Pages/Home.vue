<script setup>
import AppLayout from '../Layouts/AppLayout.vue'

const props= defineProps(['name'])
</script>

<template>
    <Toast/>
     <AppLayout>
         <h3 class="text-3xl text-neutral-900 font-medium mb-8"> Olá, {{name}} </h3>
     </AppLayout>
</template>
