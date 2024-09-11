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
    informes: {
        type: Array
    },
});

const form = useForm({
    titulo: '',
    descripcion: '',
    fecha: ''
});

const title = ref('Crear Informe');
const msj = ref('');
const classMsj = ref('hidden');

const save = () => {
    if (form.id) {
        form.put(route('informes.update', form.id), {
            onSuccess: () => {
                msj.value = 'Informe Actualizado';
                classMsj.value = 'block';
                form.reset();
            }
        });
    } else {
        form.post(route('informes.store'), {
            onSuccess: () => {
                msj.value = 'Informe Creado';
                classMsj.value = 'block';
                form.reset();
            }
        });
    }
};

const deleteInforme = (informeId) => {
    Inertia.delete(route('informes.destroy', informeId), {
        onSuccess: () => {
            msj.value = 'Informe Eliminado';
            classMsj.value = 'block';
        }
    });
};
</script>
<template>
    <Head title="Informes" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-xl font-semibold leading-tight">Informes</h1>
            <DarkButton @click="form.reset(), title = 'Crear Informe'">Crear Informe</DarkButton>
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
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="informe in informes" :key="informe.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ informe.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ informe.titulo }}</td>
                            <td class="px-4 py-3 text-sm">{{ informe.descripcion }}</td>
                            <td class="px-4 py-3 text-sm">{{ new Date(informe.fecha).toLocaleDateString() }}</td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="form.id = informe.id, form.titulo = informe.titulo, form.descripcion = informe.descripcion, form.fecha = informe.fecha, title = 'Editar Informe'">Editar</SecondaryButton>
                                <DangerButton @click="deleteInforme(informe.id)">Eliminar</DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <form @submit.prevent="save">
                <InputGroup label="Título" for="titulo" v-model="form.titulo" />
                <InputError :message="form.errors.titulo" class="mt-2" />
                <InputGroup label="Descripción" for="descripcion" v-model="form.descripcion" />
                <InputError :message="form.errors.descripcion" class="mt-2" />
                <InputGroup label="Fecha" for="fecha" type="date" v-model="form.fecha" />
                <InputError :message="form.errors.fecha" class="mt-2" />
                <PrimaryButton>{{ title }}</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
