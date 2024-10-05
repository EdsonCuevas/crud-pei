<script setup>
import Form from './Form.vue';

const props = defineProps({
    programas:{type:Object},
    coordinators:{type:Object}
});

</script>

<template>
    <Form :programas="programas" :coordinators="coordinators" />
</template>