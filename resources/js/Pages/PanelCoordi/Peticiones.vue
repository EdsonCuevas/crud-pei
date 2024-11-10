<script setup>
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';

// Props recibidos desde el controlador
const props = defineProps({
    Programas: Array,
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-4">
            <h1 class="text-xl font-bold mb-4">Peticiones</h1>
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Usuario</th>
                            <th class="py-3 px-6 text-left">Programa</th>
                            <th class="py-3 px-6 text-left">Estatus</th>
                            <th class="py-3 px-6 text-left">Aceptar</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <template v-for="(programa, index) in Programas" :key="index">
                            <tr v-for="(user, userIndex) in programa.users" :key="userIndex" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ user.name }}</td>
                                <td class="py-3 px-6 text-left">{{ programa.title }}</td>
                                <td class="py-3 px-6 text-left">
                                    <span v-if="user.pivot.approved === 1" class="text-green-500 font-semibold">Aprobado</span>
                                    <span v-else class="text-red-500 font-semibold">Pendiente</span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <SecondaryButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </SecondaryButton>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
