<script setup>
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import { ref } from 'vue';

const props = defineProps({
    donaciones: {
        type: Array
    },
});

const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');


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
            Donations
            <br>
            <br>
                <NavLink :href="route('donor-donations.create')">
                    <DarkButton class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hand-coins">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/>
                            <path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/>
                            <path d="m2 16 6 6"/>
                            <circle cx="16" cy="9" r="2.9"/>
                            <circle cx="6" cy="5" r="3"/>
                        </svg>
                        <span>Donate</span>
                    </DarkButton>
                </NavLink>
        </template>


        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Concept</th>
                            <th class="px-4 py-3">Value</th>
                            <th class="px-4 py-3">Destination</th>
                            <th class="px-4 py-3">Date Performed</th>
                            <th class="px-4 py-3">Datails</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="donacion in donaciones" :key="donacion.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ donacion.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ donacion.concept }}</td>
                            <td class="px-4 py-3 text-sm">${{ donacion.value }}</td>
                            <td class="px-4 py-3 text-sm">{{ donacion.proram.title }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(donacion.created_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('donor-donations.show', donacion.id)">
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
