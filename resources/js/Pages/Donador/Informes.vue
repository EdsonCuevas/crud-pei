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
            INFORMES
            <br>
            <br>
            <DarkButton @click="form.reset(), title = 'Crear Informe'" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus-2">
                    <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"/>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                    <path d="M3 15h6"/>
                    <path d="M6 12v6"/>
                </svg>
                <span>CREAR INFORME</span>
            </DarkButton>
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

    </AuthenticatedLayout>
</template>
