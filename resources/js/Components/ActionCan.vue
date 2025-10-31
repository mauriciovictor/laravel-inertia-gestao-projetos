<script setup>
import {usePermissionAction} from "../composables/usePermissionAction.js";
const props = defineProps(['feature', 'action'])
const permissionAction = usePermissionAction()
</script>

<template>
    <slot v-if="permissionAction.hasPermissionAction(props.feature, props.action)" />
</template>
