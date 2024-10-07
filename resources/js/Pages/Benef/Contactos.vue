<script setup>
import AuthenticatedLayout from '@/Layouts/Benef/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    contactos: {
        type: Array
    }
});



</script>

<template>
    <Head title="Contactos" />
    
    <AuthenticatedLayout>
        <template #header>
            Contactos
            <br>
            <br>
        </template>
        
        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Telefono</th>
                            <th class="px-4 py-3">Cargo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in contactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.phone }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.role.role }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        
    </AuthenticatedLayout>
</template>
