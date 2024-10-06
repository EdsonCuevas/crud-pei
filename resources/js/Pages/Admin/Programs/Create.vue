<script setup>
import Form from './Form.vue';

const props = defineProps({
    coordinators:{type:Object},
    users:{type:Object}
});

</script>

<template>
    <Form :coordinators="coordinators" :users="users" />
</template>