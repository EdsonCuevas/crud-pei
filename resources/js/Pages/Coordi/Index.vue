<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import NavLink from '@/Components/NavLink.vue';

// Props recibidos desde el controlador
const props = defineProps({
    Programas: Array,
});

const searchQuery = ref("");

const filteredProgams = computed(() => {
    if (!searchQuery.value) {
        return props.Programas; 
    }
    return props.Programas.filter(programa => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (programa.title && programa.title.toLowerCase().includes(searchLower)) ||
            (programa.created_at && programa.created_at.toLowerCase().includes(searchLower)) ||
            (programa.updated_at && programa.updated_at.toLowerCase().includes(searchLower)) ||
            (programa.creator?.name && programa.creator.name.toLowerCase().includes(searchLower))
        );
    });
});

const noResultsFound = computed(() => {
    return filteredProgams.value.length === 0 && searchQuery.value !== '';
});


</script>

<template>
    <AuthenticatedLayout>
        <template #header>Programs</template>
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by tittle, date or assigner by..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>
        <br>
        <div class="w-full overflow-hidden rounded-lg border shadow-md bg-white">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Donations collected</th>
                        <th class="px-4 py-3">Assigner by:</th>
                        <th class="px-4 py-3">Assignment date</th>
                        <th class="px-4 py-3">View</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr v-for="programa in filteredProgams" :key="programa.id" class="text-gray-700">
                        <td class="px-4 py-3 text-sm">{{ programa.title }}</td>
                        <td class="px-4 py-3 text-sm">${{ programa.total_donations || 0 }} MXN</td>
                        <td class="px-4 py-3 text-sm">{{ programa.creator ? (programa.creator.name ? programa.creator.name : '') : '' }}</td>
                        <td class="px-4 py-3 text-sm">{{ new Date(programa.created_at).toLocaleString() }}</td>
                        <td class="px-4 py-3 text-sm">
                            <NavLink :href="route('coord-programs.show', programa.id)">
                                <SecondaryButton>
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
                    </tr>
                </tbody>
            </table>
        </div>

    </AuthenticatedLayout>
</template>

