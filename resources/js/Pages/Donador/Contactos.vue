<script setup>
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    contactos: {
        type: Array
    },
    usuario: Object,
});

const searchQuery = ref("");

// Computed para filtrar contactos según la búsqueda
const filteredContactos = computed(() => {
    if (!searchQuery.value) {
        return props.contactos; // Si no hay búsqueda, mostrar todos los contactos
    }
    return props.contactos.filter(contacto => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (contacto.nombre && contacto.nombre.toLowerCase().includes(searchLower)) || // Cambio de 'name' a 'nombre'
            (contacto.email && contacto.email.toLowerCase().includes(searchLower)) ||
            (contacto.telefono && contacto.telefono.toLowerCase().includes(searchLower)) ||
            (contacto.id && String(contacto.id).toLowerCase().includes(searchLower)) || // Convertir id a string
            (contacto.direccion && contacto.direccion.toLowerCase().includes(searchLower))
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
        
        </template>

        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by #, name, e-mail, phone or address..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>
        <br>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Photo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in filteredContactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ contacto.name }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="'mailto:' + contacto.email" class="text-blue-500 hover:underline">
                                    {{ contacto.email }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="'https://api.whatsapp.com/send?phone=521' + contacto.phone + '&text=Hola%20soy%20'+ usuario.name +'%20de%20la%20Fundación%20CTI'" class="text-blue-500 hover:underline" target="_blank">
                                    {{ contacto.phone }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ contacto.role.role }}</td>
                            <td class="px-4 py-3 text-sm">
                                <img :src="contacto.photo ? `../../storage/img/profile/${contacto.photo}` : '../../storage/img/profile/profile-icon.png'" alt="Imagen de perfil" class="object-cover rounded-lg w-[50px]" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
