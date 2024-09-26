<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';

// Props recibidos desde el controlador
const props = defineProps({
    Programas: Array,
});

// Formularios para cada modal
const formWarningButton = useForm({
    description: '',
    created_at: '',
    updated_at: '',
});

const formBlueButton = useForm({
    name: '',
    description: '',
    created_at: '',
    updated_at: '',
});


const showModalFormWarning = ref(false);
const showModalFormBlue = ref(false);

// Funciones para abrir/cerrar modales
const openModalFormWarning = (programa) => {
    Object.assign(formWarningButton, programa);
    showModalFormWarning.value = true;
};

const openModalFormBlue = () => {
    formBlueButton.reset();
    showModalFormBlue.value = true;
};

const closeModalFormWarning = () => showModalFormWarning.value = false;
const closeModalFormBlue = () => showModalFormBlue.value = false;
</script>

<template>
    <AuthenticatedLayout>
        <template #header>Programas</template>

        <div class="w-full overflow-hidden rounded-lg border shadow-md bg-white">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Título</th>
                        <th class="px-4 py-3">Descripción</th>
                        <th class="px-4 py-3">Fecha de Creación</th>
                        <th class="px-4 py-3">Fecha de Modificación</th>
                        <th class="px-4 py-3">Asignador por:</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr v-for="programa in Programas" :key="programa.id" class="text-gray-700">
                        <td class="px-4 py-3 text-sm">{{ programa.name }}</td>
                        <td class="px-4 py-3 text-sm">{{ programa.description }}</td>
                        <td class="px-4 py-3 text-sm">{{ new Date(programa.created_at).toLocaleString() }}</td>
                        <td class="px-4 py-3 text-sm">{{ new Date(programa.updated_at).toLocaleString() }}</td>
                        <td class="px-4 py-3 text-sm">{{programa.creator.name}}</td>

                        <td class="px-4 py-3 text-sm">
                            <WarningButton @click="openModalFormWarning(programa)">
                            <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" 
                                    stroke="currentColor" 
                                    class="w-6 h-6"
                            >
                                    <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 
                                        4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            </WarningButton>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2" 
                            @click="openModalFormBlue">
                            <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" viewBox="0 0 24 24" 
                                    stroke-width="2" 
                                    stroke="currentColor" 
                                    class="w-6 h-6"
                            >
                                    <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal de programa-->
        <Modal :show="showModalFormWarning" @close="closeModalFormWarning">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Programa</h2>
                <div class="mt-6 mb-6 space-y-6 max-w-xl">
                    <InputGroup :text="'Titulo'" :required="'required'" v-model="formWarningButton.title">
                    <svg 
                            xmlns="http://www.w3.org/2000/svg"
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" stroke="currentColor" 
                            stroke-width="1.5" stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="w-5 h-5 text-gray-400"
                    >
                            <polyline points="4 7 4 4 20 4 20 7"/>
                            <line x1="9" y1="20" x2="15" y2="20"/>
                            <line x1="12" y1="4" x2="12" y2="20"/>
                    </svg>
                    </InputGroup>

                    <InputGroup text="Descripción" required v-model="formWarningButton.description">
                    <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="24" height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="1.5" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="w-5 h-5 text-gray-400"
                        >
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    </InputGroup>
                <InputGroup type="text" text="Fecha de Creación" required v-model="formWarningButton.created_at">
                <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="1.5" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="w-5 h-5 text-gray-400"
                >
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                </InputGroup>

                <InputGroup text="Fecha de Modificación" required v-model="formWarningButton.updated_at">
                    <svg 
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="1.5" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="w-5 h-5 text-gray-400"
                    >
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </InputGroup>
                </div>
                <div class="flex justify-end space-x-2">
                    <SecondaryButton @click="closeModalFormWarning">Cancelar</SecondaryButton>
                    <PrimaryButton @click="saveWarningButton">Guardar</PrimaryButton>
                </div>
            </div>
        </Modal>

        <!-- Modal boton azul programas--> 
        <Modal :show="showModalFormBlue" @close="closeModalFormBlue">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Crear Programa</h2>
                <div class="mt-6 mb-6 space-y-6 max-w-xl">
                    <InputGroup text="Título" required v-model="formBlueButton.title">
                        <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5 text-gray-400"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M16.5 3.75H7.5m1.875 3.75h5.25M12 17.25V20m-3-6h6a2.25 2.25 0 0 0
                                2.25-2.25V5.25A2.25 2.25 0 0 0 15 3H9A2.25 2.25
                                0 0 0 6.75 5.25v6.75A2.25 2.25 0 0 0 9 14.25Z" />
                        </svg>
                    </InputGroup>
                    <InputGroup text="Descripción" required v-model="formBlueButton.description">
                        <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5 text-gray-400"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M4.5 6.75H19.5m-15 
                                4.5h10.5M4.5 16.5H19.5m-6-9.75h1.5a.75.75 0 0 
                                1 0 1.5H13.5a.75.75 0 0 1 0-1.5Z" />
                        </svg>
                    </InputGroup>
                    <InputGroup text="Fecha de Creación" required v-model="formBlueButton.created_at">
                        <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5 text-gray-400"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M4.5 6.75H19.5m-15 4.5h10.5M4.5 16.5H19.5m-6-9.75h1.5a.75.75 0 0 1 0 1.5H13.5a.75.75 0 0 1 0-1.5Z" />
                        </svg>
                    </InputGroup>
                    <InputGroup text="Fecha de Modificación" required v-model="formBlueButton.updated_at">
                        <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5 text-gray-400"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M4.5 6.75H19.5m-15 4.5h10.5M4.5 16.5H19.5m-6-9.75h1.5a.75.75 0 0 1 0 1.5H13.5a.75.75 0 0 1 0-1.5Z" />
                        </svg>
                    </InputGroup>
                </div>
                <div class="flex justify-end space-x-2">
                    <SecondaryButton @click="closeModalFormBlue">Cancelar</SecondaryButton>
                    <PrimaryButton @click="saveBlueButton">Guardar</PrimaryButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

