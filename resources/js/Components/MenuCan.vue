<script setup>
import {useMenuActive} from "../composables/useMenuActive.js";
const props = defineProps(['can'])
const menuActive = useMenuActive()
</script>

<template>
    <slot v-if="menuActive.hasMenuPermission(props.can)" />
</template>
