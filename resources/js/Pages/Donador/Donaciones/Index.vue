<script setup>
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    donaciones: {
        type: Array
    },
});

const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');
const searchQuery = ref(''); // Estado para el término de búsqueda

const ok = (m) => {
    if (operation.value == 2) {
        closeModalForm();
    }
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
};
const filteredDonations = computed(() => {
    return props.donaciones.filter(donacion => {
        const query = searchQuery.value.toLowerCase();
        const formattedDate = new Date(donacion.created_at).toLocaleString().toLowerCase(); // Convertimos la fecha a cadena legible
        return donacion.concept.toLowerCase().includes(query) ||
               donacion.value.toString().includes(query) ||
               donacion.proram.title.toLowerCase().includes(query) ||
               formattedDate.includes(query);  // Añadimos la fecha como parte de la búsqueda
    });
});
const noResultsFound = computed(() => {
    return filteredDonations.value.length === 0 && searchQuery.value !== '';
});
</script>

<template>
    <Head title="Donadores" />

    <AuthenticatedLayout>
        <template #header>
            Donations
            <br><br>
            <NavLink :href="route('donor-donations.create')">
                <button class="w-20 bg-gradient-to-r py-2 from-[#004481] to-[#1464A5] text-white font-bold rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481] flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-hand-coins">
                        <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                        <path
                            d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                        <path d="m2 16 6 6" />
                        <circle cx="16" cy="9" r="2.9" />
                        <circle cx="6" cy="5" r="3" />
                    </svg>
                </button>
            </NavLink>
        </template>

        <!-- Buscador -->
        <div class="mb-6 ">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by #, concept, value, destination, or date..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                style="width: 500px;" 
            />
        </div>
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>
        <br>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Concept</th>
                            <th class="px-4 py-3">Value</th>
                            <th class="px-4 py-3">Destination</th>
                            <th class="px-4 py-3">Date Performed</th>
                            <th class="px-4 py-3">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="(donacion, index) in filteredDonations.reverse()" :key="donacion.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ filteredDonations.length - index }}</td> <!-- Número invertido -->
                            <td class="px-4 py-3 text-sm">{{ donacion.concept }}</td>
                            <td class="px-4 py-3 text-sm">${{ donacion.value }}</td>
                            <td class="px-4 py-3 text-sm">{{ donacion.proram.title }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(donacion.created_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('donor-donations.show', donacion.id)">
                                    <SecondaryButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </SecondaryButton>
                                </NavLink>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="showModalView" @close="closeModalView">
        <template #title>Volunteer: {{ v.name }}</template>
        <template #content>
            <div>
                <p><strong>Phone:</strong> {{ v.phone }}</p>
                <p><strong>Programs:</strong></p>
                <ul>
                    <li v-for="program in v.programs" :key="program.id">{{ program.name }}</li>
                </ul>
            </div>
        </template>
        <template #footer>
            <SecondaryButton @click="closeModalView">Close</SecondaryButton>
        </template>
    </Modal>

    <div :class="classMsj" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-4">
        {{ msj }}
    </div>
</template>
