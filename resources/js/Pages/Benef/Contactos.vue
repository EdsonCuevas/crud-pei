<script setup>
import AuthenticatedLayout from '@/Layouts/Benef/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    contactos: {
        type: Array
    }
});

// Variable para almacenar la consulta de búsqueda
const searchQuery = ref("");

// Computed para filtrar contactos según la búsqueda
const filteredContactos = computed(() => {
    if (!searchQuery.value) {
        return props.contactos; // Si no hay búsqueda, mostrar todos los contactos
    }
    return props.contactos.filter(contacto => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (contacto.name && contacto.name.toLowerCase().includes(searchLower)) ||
            (contacto.email && contacto.email.toLowerCase().includes(searchLower)) ||
            (contacto.phone && contacto.phone.toLowerCase().includes(searchLower)) ||
            (contacto.role && contacto.role.role.toLowerCase().includes(searchLower))
        );
    });
});
const noResultsFound = computed(() => {
    return filteredContactos.value.length === 0 && searchQuery.value !== '';
});
</script>

<template>
    <Head title="Contactos" />
    
    <AuthenticatedLayout>
        <template #header>
            Contacts
            <br>
            <br>
        </template>
        
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by name, e-mail, phone or charge..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>
        <br>
        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Charge</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in filteredContactos" :key="contacto.id" class="text-gray-700">
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
