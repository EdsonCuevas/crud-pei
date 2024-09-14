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
    voluntarios: {
        type: Array
    },
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
});

const v = ref({
    id: '',
    name: '',
    phone: '',
    password: '',
    programs: []
});

const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (a) => {
    v.value.name = a.name;
    v.value.phone = a.phone;
    v.value.programs = a.programs;
    showModalView.value = true;
};

const openModalForm = (op, a) => {
    showModalForm.value = true;
    operation.value = op;
    if (op === 1) {
        title.value = 'Crear Voluntario';
    } else {
        title.value = 'Editar Voluntario';
        form.name = a.name;
        form.email = a.email;
        form.password = '';
        form.phone = a.phone;
        v.value.id = a.id;
    }
};

const openModalDel = () => {
    showModalDel.value = true;
};

const closeModalView = () => {
    showModalView.value = false;
};

const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
};

const closeModalDel = () => {
    showModalDel.value = false;
};

const save = () => {
    if (operation.value === 1) {
        form.post(route('voluntarios.store'), {
            onSuccess: () => ok('Voluntario Creado'),
        });
    } else {
        form.put(route('voluntarios.update', v.value.id), {
            onSuccess: () => ok('Voluntario Actualizado'),
        });
    }
};

const ok = (m) => {
    if (operation.value == 2) {
        closeModalForm();
    }
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
};

</script>

<template>
    <Head title="Donadores" />

    <AuthenticatedLayout>
        <template #header>
            Donadores
            <br>
            <br>
            <DarkButton @click="openModalForm(1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </DarkButton>
        </template>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Titulo</th>
                            <th class="px-4 py-3">Fecha de Realizada</th>
                            <th class="px-4 py-3">Destino</th>
                            <th class="px-4 py-3">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="voluntario in voluntarios" :key="voluntario.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ voluntario.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ voluntario.name }}</td>
                            <td class="px-4 py-3 text-sm">{{ voluntario.email }}</td>
                            <td class="px-4 py-3 text-sm">{{ voluntario.phone }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(voluntario.created_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(voluntario.updated_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(voluntario)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </SecondaryButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <WarningButton @click="openModalForm(2, voluntario)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openModalDel">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.166L19.674 5.5A2.25 2.25 0 0 0 17.577 4H6.423a2.25 2.25 0 0 0-2.097 1.5L3.75 5.79m15.478 0a48.108 48.108 0 0 0-13.456 0m13.456 0 .264 1.855c.194 1.363.29 2.731.288 4.1a48.148 48.148 0 0 1-.346 5.451l-.264 1.855a2.25 2.25 0 0 1-2.097 1.5H6.423a2.25 2.25 0 0 1-2.097-1.5L4.062 17.2a48.153 48.153 0 0 1-.346-5.451c-.002-1.369.094-2.737.288-4.1L4.268 5.79M10.5 6h3m-6.75 0h9" />
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="showModalView" @close="closeModalView">
        <template #title>Voluntario: {{ v.name }}</template>
        <template #content>
            <div>
                <p><strong>Teléfono:</strong> {{ v.phone }}</p>
                <p><strong>Programas:</strong></p>
                <ul>
                    <li v-for="program in v.programs" :key="program.id">{{ program.name }}</li>
                </ul>
            </div>
        </template>
        <template #footer>
            <SecondaryButton @click="closeModalView">Cerrar</SecondaryButton>
        </template>
    </Modal>

    <Modal :show="showModalForm" @close="closeModalForm">
        <template #title>{{ title }}</template>
        <template #content>
            <form @submit.prevent="save">
                <InputGroup label="Nombre" for="name" :value="form.name" v-model="form.name" />
                <InputError :message="form.errors.name" class="mt-2" />
                <InputGroup label="Email" for="email" :value="form.email" v-model="form.email" />
                <InputError :message="form.errors.email" class="mt-2" />
                <InputGroup label="Teléfono" for="phone" :value="form.phone" v-model="form.phone" />
                <InputError :message="form.errors.phone" class="mt-2" />
                <InputGroup label="Contraseña" for="password" :value="form.password" v-model="form.password" />
                <InputError :message="form.errors.password" class="mt-2" />
            </form>
        </template>
        <template #footer>
            <SecondaryButton @click="closeModalForm">Cancelar</SecondaryButton>
            <PrimaryButton @click="save">Guardar</PrimaryButton>
        </template>
    </Modal>

    <Modal :show="showModalDel" @close="closeModalDel">
        <template #title>Eliminar Voluntario</template>
        <template #content>
            <p>¿Estás seguro de que deseas eliminar este voluntario?</p>
        </template>
        <template #footer>
            <SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
            <DangerButton @click="deleteVoluntario">Eliminar</DangerButton>
        </template>
    </Modal>

    <div :class="classMsj" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4">
        {{ msj }}
    </div>
</template>
