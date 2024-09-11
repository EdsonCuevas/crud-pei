<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
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
    }
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    position: '',
    schedule: '',
    address: ''
});

const v = ref({
    id: '',
    name: '',
    phone: '',
    password: '',
    position: '',
    schedule: '',
    address: ''
});

const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (contacto) => {
    v.value = { ...contacto }; // Simplificación del código
    showModalView.value = true;
}

const openModalForm = (op, contacto) => {
    showModalForm.value = true;
    operation.value = op;
    if (op === 1) {
		title.value = 'Crear Contacto';
		form.reset();
	} else {
		title.value = 'Editar Contacto';
		form.name = contacto.name;
		form.email = contacto.email;
		form.phone = contacto.phone;
		form.position = contacto.position;
		form.schedule = contacto.schedule;
		form.address = contacto.address;
		v.value.id = contacto.id;
	}
}

const openModalDel = (id) => {
    v.value.id = id;
    showModalDel.value = true;
}

const closeModalView = () => {
    showModalView.value = false;
}

const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
}

const closeModalDel = () => {
    showModalDel.value = false;
}

const save = () => {
    if (operation.value === 1) {
        form.post(route('contacts.store'), {
            onSuccess: () => ok('Contacto Creado'),
        });
    } else {
        form.put(route('contacts.update', v.value.id), {
            onSuccess: () => ok('Contacto Actualizado'),
        });
    }
};

const ok = (mensaje) => {
    if (operation.value == 2) {
        closeModalForm();
    }
    closeModalDel();
    form.reset();
    msj.value = mensaje;
    classMsj.value = 'block';
}

</script>

<template>
    <Head title="Contacts" />
    
    <AuthenticatedLayout>
        <template #header>
            Contactos
            <br>
            <br>
            <DarkButton @click="openModalForm(1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </DarkButton>
        </template>
        
        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Telefono</th>
                            <th class="px-4 py-3">Cargo</th>
                            <th class="px-4 py-3">Horario</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in contactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.id }}
                            </td>
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
                                {{ contacto.position }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.schedule }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(contacto)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 12h6M9 19h6" />
                                    </svg>
                                </SecondaryButton>
                                <WarningButton @click="openModalDel(contacto.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </WarningButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal para ver detalles -->
        <Modal :show="showModalView" @close="closeModalView">
            <template #title>
                {{ v.name }}
            </template>
            <template #content>
                <div>
                    <p>Telefono: {{ v.phone }}</p>
                    <p>Cargo: {{ v.position }}</p>
                    <p>Horario: {{ v.schedule }}</p>
                    <p>Dirección: {{ v.address }}</p>
                </div>
            </template>
            <template #footer>
                <SecondaryButton @click="closeModalView">Cerrar</SecondaryButton>
            </template>
        </Modal>
        
        <!-- Modal para formulario -->
        <Modal :show="showModalForm" @close="closeModalForm">
            <template #title>
                {{ title }}
            </template>
            <template #content>
                <div>
                    <InputGroup>
                        <label for="name">Nombre:</label>
                        <input id="name" v-model="form.name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </InputGroup>

                    <InputGroup>
                        <label for="email">Email:</label>
                        <input id="email" v-model="form.email" />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </InputGroup>

                    <InputGroup>
                        <label for="phone">Teléfono:</label>
                        <input id="phone" v-model="form.phone" />
                        <InputError :message="form.errors.phone" class="mt-2" />
                    </InputGroup>

                    <InputGroup>
                        <label for="position">Cargo:</label>
                        <input id="position" v-model="form.position" />
                        <InputError :message="form.errors.position" class="mt-2" />
                    </InputGroup>

                    <InputGroup>
                        <label for="schedule">Horario:</label>
                        <input id="schedule" v-model="form.schedule" />
                        <InputError :message="form.errors.schedule" class="mt-2" />
                    </InputGroup>

                    <InputGroup>
                        <label for="address">Dirección:</label>
                        <input id="address" v-model="form.address" />
                        <InputError :message="form.errors.address" class="mt-2" />
                    </InputGroup>

                    <InputGroup v-if="operation === 2">
                        <label for="password">Contraseña:</label>
                        <input id="password" type="password" v-model="form.password" />
                        <InputError :message="form.errors.password" class="mt-2" />
                    </InputGroup>
                </div>
            </template>
            <template #footer>
                <PrimaryButton @click="save">Guardar</PrimaryButton>
                <SecondaryButton @click="closeModalForm">Cancelar</SecondaryButton>
            </template>
        </Modal>
        
        <!-- Modal de confirmación de eliminación -->
        <Modal :show="showModalDel" @close="closeModalDel">
            <template #title>
                Eliminar Contacto
            </template>
            <template #content>
                <p>¿Estás seguro de que deseas eliminar este contacto?</p>
            </template>
            <template #footer>
                <PrimaryButton @click="form.delete(route('contacts.destroy', v.id))">Eliminar</PrimaryButton>
                <SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
            </template>
        </Modal>
        
    </AuthenticatedLayout>
</template>

<style>
/* Agrega aquí estilos personalizados si es necesario */
</style>
