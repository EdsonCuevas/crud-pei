<script setup>
import Form from './Form.vue';

const props = defineProps({
    program:{type:Object},
    coordinators:{type:Object},
    users:{type:Object},
    benefsDelPrograma:{type:Object}
});

</script>

<template>
    <Form :program="program" :coordinators="coordinators" :users="users" :benefsDelPrograma="benefsDelPrograma" />
</template>