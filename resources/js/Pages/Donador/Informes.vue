<script setup>
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import { ref, computed } from 'vue';
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

const title = ref('Create Report');
const msj = ref('');
const classMsj = ref('hidden');

const save = () => {
    if (form.id) {
        form.put(route('informes.update', form.id), {
            onSuccess: () => {
                msj.value = 'Updated Report';
                classMsj.value = 'block';
                form.reset();
            }
        });
    } else {
        form.post(route('informes.store'), {
            onSuccess: () => {
                msj.value = 'Report Created';
                classMsj.value = 'block';
                form.reset();
            }
        });
    }
};

const deleteInforme = (informeId) => {
    Inertia.delete(route('informes.destroy', informeId), {
        onSuccess: () => {
            msj.value = 'Report Eliminated';
            classMsj.value = 'block';
        }
    });
};

// Variable para almacenar la consulta de búsqueda
const searchQuery = ref("");

// Computed para filtrar programas según la búsqueda
const filteredInformes = computed(() => {
    if (!searchQuery.value) {
        return props.informes;
    }
    return props.informes.filter(informe => { // Corregido: props.informes, no props.informe
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (informe.id && String(informe.id).toLowerCase().includes(searchLower)) || 
            (informe.titulo && informe.titulo.toLowerCase().includes(searchLower)) || 
            (informe.descripcion && informe.descripcion.toLowerCase().includes(searchLower)) || 
            (informe.fecha && informe.fecha.toLowerCase().includes(searchLower))
        );
    });
});

const noResultsFound = computed(() => {
    return filteredInformes.value.length === 0 && searchQuery.value !== '';
});
</script>
<template>
    <Head title="Informes" />

    <AuthenticatedLayout>
        <template #header>
            Reports
            <br>
            <br>
            <DarkButton @click="form.reset(), title = 'Create Report'" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus-2">
                    <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"/>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
                    <path d="M3 15h6"/>
                    <path d="M6 12v6"/>
                </svg>
                <span>Create Report</span>
            </DarkButton>
        </template>

        <div class="mb-6 ">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by #, tittle, description or date..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                style="width: 500px;" 
            />
        </div>

        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>
        <br>

        <div :class="classMsj" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4">
            {{ msj }}
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="informe in filteredInformes" :key="informe.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ informe.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ informe.titulo }}</td>
                            <td class="px-4 py-3 text-sm">{{ informe.descripcion }}</td>
                            <td class="px-4 py-3 text-sm">{{ new Date(informe.fecha).toLocaleDateString() }}</td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="form.id = informe.id, form.titulo = informe.titulo, form.descripcion = informe.descripcion, form.fecha = informe.fecha, title = 'Editar Informe'">Edit</SecondaryButton>
                                <DangerButton @click="deleteInforme(informe.id)">Delete</DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
