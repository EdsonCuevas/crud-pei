<script setup>
import Form from './Form.vue';

const props = defineProps({
    programas:{type:Object},
    program:{type:Object},
    creator:{type:Object},
    coordinators:{type:Object},
    users:{type:Object}
});

</script>

<template>
    <Form :programas="programas" :program="program" :creator="creator" :coordinators="coordinators" :users="users" />
</template>