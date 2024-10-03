<script setup>
import Form from './Form.vue';

const props = defineProps({
    programas:{type:Object}
});

</script>

<template>
    <Form :programas="programas" />
</template>