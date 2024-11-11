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
});

const form = useForm({
    nombre: '',
    email: '',
    telefono: '',
    direccion: ''
});

const title = ref('Create Contact');
const msj = ref('');
const classMsj = ref('hidden');

const save = () => {
    if (form.id) {
        form.put(route('contactos.update', form.id), {
            onSuccess: () => {
                msj.value = 'Updated Contact';
                classMsj.value = 'block';
                form.reset();
            }
        });
    } else {
        form.post(route('contactos.store'), {
            onSuccess: () => {
                msj.value = 'Contact Created';
                classMsj.value = 'block';
                form.reset();
            }
        });
    }
};

const deleteContacto = (contactoId) => {
    Inertia.delete(route('contactos.destroy', contactoId), {
        onSuccess: () => {
            msj.value = 'Contact Deleted';
            classMsj.value = 'block';
        }
    });
};

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
</script>

<template>
    <Head title="Contactos" />

    <AuthenticatedLayout>
        <template #header>
            Contacts
            <br>
            <br>
        </template>

        <div :class="classMsj" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4">
            {{ msj }}
        </div>

        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by #, name, e-mail, phone or address..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Address</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in filteredContactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ contacto.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.nombre }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.email }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.telefono }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.direccion }}</td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="form.id = contacto.id, form.nombre = contacto.nombre, form.email = contacto.email, form.telefono = contacto.telefono, form.direccion = contacto.direccion, title = 'Editar Contacto'">Edit</SecondaryButton>
                                <DangerButton @click="deleteContacto(contacto.id)">Delete</DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
