<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';

const props = defineProps({
    program:{type:Object},
    creator:{type:Object},
    coordinator:{type:Object},
    users:{type:Object}
});

</script>

<template>
    <Head title="Programa" />
    <AuthenticatedLayout>
        <template #header>
            <div class="inline-flex overflow-hidden mb-4 w-full">
                {{ program.title }}
            </div>
        </template>
        <div class="grid gap-6 bg-white mb-8 md:grid-cols-2 border rounded-lg">
            <div class="win-w-0 p-4 rounded-lg shadow-xs">
                <p>Descripcion: <span class="text-gray-900 font-semibold">{{ program.description }}</span></p>
                <p>Creado por: <span class="text-gray-900 font-semibold">{{ creator.name }}</span></p>
                <p>Coordinado por: <span class="text-gray-900 font-semibold">{{ coordinator.name }}</span></p>
                <p>Fecha de Creacion: <span class="text-gray-900 font-semibold">{{ new Date(program.created_at).toLocaleString() }}</span></p>
                <p>Ultima Modificacion: <span class="text-gray-900 font-semibold">{{ new Date(program.updated_at).toLocaleString() }}</span></p>
                <p>Beneficiarios: 
                    <span v-for="b,i in users" class="text-gray-900 font-semibold">
                        <a v-if="i == (users.length-1)">{{ b.name }}</a>
                        <a v-else>{{ b.name + ', ' }}</a>
                    </span>
                </p>
            </div>
            <div class="win-w-0 p-4 rounded-lg shadow-xs">
                <img :src="`/storage/img/${program.image}`" :alt="program.title" width="500">

            </div>
        </div>
    </AuthenticatedLayout>
</template>