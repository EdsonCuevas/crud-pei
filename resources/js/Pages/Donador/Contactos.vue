<script setup>
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
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

const title = ref('Crear Contacto');
const msj = ref('');
const classMsj = ref('hidden');

const save = () => {
    if (form.id) {
        form.put(route('contactos.update', form.id), {
            onSuccess: () => {
                msj.value = 'Contacto Actualizado';
                classMsj.value = 'block';
                form.reset();
            }
        });
    } else {
        form.post(route('contactos.store'), {
            onSuccess: () => {
                msj.value = 'Contacto Creado';
                classMsj.value = 'block';
                form.reset();
            }
        });
    }
};

const deleteContacto = (contactoId) => {
    Inertia.delete(route('contactos.destroy', contactoId), {
        onSuccess: () => {
            msj.value = 'Contacto Eliminado';
            classMsj.value = 'block';
        }
    });
};
</script>
<template>
    <Head title="Contactos" />

    <AuthenticatedLayout>
        <template #header>
            CONTACTOS
            <br>
            <br>
        </template>

        <div :class="classMsj" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4">
            {{ msj }}
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Teléfono</th>
                            <th class="px-4 py-3">Dirección</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in contactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ contacto.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.nombre }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.email }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.telefono }}</td>
                            <td class="px-4 py-3 text-sm">{{ contacto.direccion }}</td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="form.id = contacto.id, form.nombre = contacto.nombre, form.email = contacto.email, form.telefono = contacto.telefono, form.direccion = contacto.direccion, title = 'Editar Contacto'">Editar</SecondaryButton>
                                <DangerButton @click="deleteContacto(contacto.id)">Eliminar</DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
