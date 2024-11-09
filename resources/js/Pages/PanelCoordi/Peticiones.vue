<script setup>
import { useForm } from '@inertiajs/vue3';
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
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr v-for="(programa, index) in Programas" :key="index" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ programa.user.name }}</td>
                            <td class="py-3 px-6 text-left">{{ programa.program_name }}</td>
                            <td class="py-3 px-6 text-left">
                                <span v-if="programa.approved === 1" class="text-green-500 font-semibold">Aprobado</span>
                                <span v-else class="text-red-500 font-semibold">Pendiente</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
