<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Pagination from '@/Components/Pagination.vue';
import DangerButton from '@/Components/DangerButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Swal from 'sweetalert2'; // Importar SweetAlert
import { ref, computed } from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    programas: {
        type: Object
    },
    flash: {
        type: Object
    }
});

const exportPrograms = () => {
    window.location.href = '/export-programs';
}

const form = useForm({ id: '', title: '', description: '' });

const openDeleteConfirmation = (programa) => {
    form.id = programa.id;
    form.title = programa.title;
    form.description = programa.description;

    // Mostrar alerta de confirmación con SweetAlert
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete the program "${programa.title}"`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteProgram();
        }
    });
}

const deleteProgram = () => {
    form.delete(route('admin-programs.destroy', form.id), {
        onSuccess: () => {
            Swal.fire({
                title: 'Deleted!',
                text: 'The program has been deleted.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        },
        onError: () => {
            Swal.fire({
                title: 'Error',
                text: 'There was an error deleting the program.',
                icon: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}

// Variable para almacenar la consulta de búsqueda
const searchQuery = ref("");

const filteredPrograms = computed(() => {
    if (!searchQuery.value) {
        return props.programas.data;
    }

    const searchLower = searchQuery.value.toLowerCase();
    const regex = new RegExp(searchLower, "i"); // Crear expresión regular insensible a mayúsculas

    return props.programas.data.filter(programa => {
        // Normalizar fecha y hora para asegurarse de que estén en un formato consistente
        const createdAt = programa.created_at
            ? new Date(programa.created_at).toLocaleString("es-ES", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
            })
            : "";

        return (
            String(programa.id).match(regex) ||
            (programa.title && programa.title.match(regex)) ||
            (programa.creator && programa.creator.name && programa.creator.name.match(regex)) ||
            (programa.coordinator && programa.coordinator.name && programa.coordinator.name.match(regex)) ||
            createdAt.match(regex) // Comparar la fecha/hora formateada con la búsqueda
        );
    });
});

const noResultsFound = computed(() => {
    return filteredPrograms.value.length === 0 && searchQuery.value !== '';
});

</script>

<template>

    <Head title="Programas" />

    <AuthenticatedLayout>
        <template #header>
            Programas
            <br>
            <br>
            <div class="flex justify-between">
                <NavLink :href="route('admin-programs.create')">
                    <button class="w-20 bg-gradient-to-r py-2 from-[#004481] to-[#1464A5] text-white font-bold rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481] flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </button>
                </NavLink>
                <div class="flex items grid-cols-2 gap-2">
                    <a href="admin-programs-pdf">
                        <button
                            style="background-color: white; border: 2px solid red; padding: 10px; border-radius: 8px;">
                            <img src="storage/img/pdf.png" style="width: 24px; height: 24px;">
                        </button>
                    </a>
                    <button @click="exportPrograms"
                        style="background-color: white; border: 2px solid green; padding: 10px; border-radius: 8px;">
                        <img src="storage/img/EXLG.png" style="width: 24px; height: 24px;">
                    </button>
                </div>
            </div>
        </template>
        <div class="mb-6 relative" style="width: 500px;">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search by #, title, creator, coordinator or date..."
                class="pl-10 pr-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none w-full"
            />
            <!-- Ícono de lupa -->
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </span>
        </div>
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Creator</th>
                            <th class="px-4 py-3">Coordinator</th>
                            <th class="px-4 py-3">Date of Creation</th>
                            <th class="px-4 py-3">Details</th>
                            <th class="px-4 py-3">Edit</th>
                            <th class="px-4 py-3">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="programa in filteredPrograms" :key="programa.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ programa.id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ programa.title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ programa.creator ? (programa.creator.name ? programa.creator.name : '') : '' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ programa.coordinator ? (programa.coordinator.name ? programa.coordinator.name : '') :
                                '' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(programa.created_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('admin-programs.show', programa.id)">
                                    <SecondaryButton @click="openModalView(coordi)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </SecondaryButton>
                                </NavLink>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('admin-programs.edit', programa.id)">
                                    <WarningButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </WarningButton>
                                </NavLink>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openDeleteConfirmation(programa)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                <pagination :links="programas.links" />
            </div>
        </div>
        <br>
    </AuthenticatedLayout>
</template>
