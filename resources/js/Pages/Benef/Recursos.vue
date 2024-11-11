<script setup>
import AuthenticatedLayout from '@/Layouts/Benef/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2'; // Importar SweetAlert2

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    programas: {
        type: Array
    },
    userPrograms: Array,
});


// Variables para el título y la descripción del programa
const selectedProgram = ref({
    title: '',
    description: '',
    image: ''
});

const showModalView = ref(false);

const openModalView = (programa) => {

    // Pasamos el título y la descripción del programa
    selectedProgram.value.title = programa.title;
    selectedProgram.value.description = programa.description;
    selectedProgram.value.image = programa.image;

    showModalView.value = true;
}

const closeModalView = () => {
    showModalView.value = false;
}

const registerUserToProgram = (programId) => {
    Swal.fire({
        title: "Are you sure you want to register?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, register!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('programs.register'), { program_id: programId }, {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Registered!',
                        text: 'Your registration has been successful!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                onError: (errors) => {
                    // Verifica si hay un error específico en el campo 'program'
                    if (errors.program) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'You can not register again', // Muestra el mensaje de error específico
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
    });
};

// Variable para almacenar la consulta de búsqueda
const searchQuery = ref("");

// Computed para filtrar programas según la búsqueda
const filteredRecursos = computed(() => {
    if (!searchQuery.value) {
        return props.programas; // Filtra los programas en lugar de los contactos
    }
    return props.programas.filter(programa => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (programa.title && programa.title.toLowerCase().includes(searchLower)) || // Cambié "tittle" por "title"
            (programa.coordinator && programa.coordinator.name && programa.coordinator.name.toLowerCase().includes(searchLower)) // Asegúrate de que "coordinator.name" exista
        );
    });
});


</script>


<template>

    <Head title="Beneficiario" />

    <AuthenticatedLayout>
        <template #header>
            Resources
            <br>
            <br>
        </template>
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by program or administered by..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Program</th>
                            <th class="px-4 py-3">Administered by</th>
                            <th class="px-4 py-3">Details</th>
                            <th class="px-4 py-3">Register</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="programa in filteredRecursos" :key="programa.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ programa.title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ programa.coordinator ? (programa.coordinator.name ? programa.coordinator.name : '') :
                                    '' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(programa)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </SecondaryButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton :disabled="props.userPrograms.includes(programa.id)"
                                    @click="registerUserToProgram(programa.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>
                                </SecondaryButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal de vista del programa seleccionado -->
        <Modal :show="showModalView" @close="closeModalView">
            <div class="p-6">
                <h2 class="text-xl font-bold">{{ selectedProgram.title }}</h2>
                <p class="mt-2">{{ selectedProgram.description }}</p>
                <img v-if="selectedProgram.image" :src="`/storage/img/${selectedProgram.image}`"
                    alt="Imagen del programa" class="mt-4 w-full h-[500px] rounded-lg">
            </div>
            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Close</SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
