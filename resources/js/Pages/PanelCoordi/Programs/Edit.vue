<script setup>
import Form from './Form.vue';

const props = defineProps({
    program: { type: Object },
    users: { type: Object },
    benefsDelPrograma: { type: Object }
});
</script>

<template>
    <Form :program="program" :users="users" :benefsDelPrograma="benefsDelPrograma" />
</template>
