<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
            <h1 class="text-xl font-semibold leading-tight">Contactos</h1>
            <DarkButton @click="form.reset(), title = 'Crear Contacto'">Crear Contacto</DarkButton>
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

        <div class="mt-4">
            <form @submit.prevent="save">
                <InputGroup label="Nombre" for="nombre" v-model="form.nombre" />
                <InputError :message="form.errors.nombre" class="mt-2" />
                <InputGroup label="Email" for="email" v-model="form.email" />
                <InputError :message="form.errors.email" class="mt-2" />
                <InputGroup label="Teléfono" for="telefono" v-model="form.telefono" />
                <InputError :message="form.errors.telefono" class="mt-2" />
                <InputGroup label="Dirección" for="direccion" v-model="form.direccion" />
                <InputError :message="form.errors.direccion" class="mt-2" />
                <PrimaryButton>{{ title }}</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
