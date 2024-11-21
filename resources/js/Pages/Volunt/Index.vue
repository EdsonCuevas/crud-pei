<script setup>
import AuthenticatedLayout from '@/Layouts/Volunt/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Gastos from '@/Components/Gastos.vue';
import RegistrarGastos from '@/Components/RegistrarGastos.vue';

import { ref, computed } from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    expenses: {
        type: Array,
    }
});

const showModal = ref(false);
const isOpen = ref(false);
const selectedExpense = ref(null); // Almacenamos el gasto seleccionado

const openModal = () => {
    isOpen.value = true;
};

const openModalView = (expense) => {
    showModal.value = true;
    selectedExpense.value = expense; // Asignamos el gasto seleccionado
};

const closeModal2 = () => {
    isOpen.value = false;
};

const closeModal = () => {
    showModal.value = false;
};

const searchQuery = ref("");

const filteredExpenses = computed(() => {
    if (!searchQuery.value) {
        return props.expenses; // Cambiar 'contactos' por 'expenses'
    }
    return props.expenses.filter(expense => { // Cambiar 'contacto' por 'expense'
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (expense.id && String(expense.id).toLowerCase().includes(searchLower)) ||
            (expense.value && String(expense.value).toLowerCase().includes(searchLower)) ||
            (expense.reason && expense.reason.toLowerCase().includes(searchLower)) ||
            (expense.created_at && expense.created_at.toLowerCase().includes(searchLower))
        );
    });
});
const noResultsFound = computed(() => {
    return filteredExpenses.value.length === 0 && searchQuery.value !== '';
});


</script>

<template>

    <Head title="Expenses" />

    <AuthenticatedLayout>

        <template #header>
            Expenses
        </template>
        <div class="">

            <button 
            @click="openModal"
            class="w-20 bg-gradient-to-r py-2 from-[#004481] to-[#1464A5] text-white font-bold rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481] flex justify-center items-center"
        >
            <svg 
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-ticket-plus"
            >
                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" />
                <path d="M9 12h6" />
                <path d="M12 9v6" />
            </svg>
        </button>
            <br>
            <div class="mb-6 relative" style="width: 500px;">
                <input v-model="searchQuery" type="text" placeholder="Search by #, value, reason or date..."
                    class="pl-10 pr-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none w-full" />
                <!-- Ícono de lupa -->
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-search">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </span>
            </div>
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
                            <th class="px-4 py-3">Value</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="expense in filteredExpenses" :key="expense.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ expense.id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                ${{ expense.value }} MXN
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ expense.reason }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ new Date(expense.created_at).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(expense)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-receipt">
                                        <path
                                            d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                                        <path d="M12 17.5v-11" />
                                    </svg>
                                </SecondaryButton>

                                <Modal :show="showModal" @close="closeModal" maxWidth="lg">
                                    <Gastos :expense="selectedExpense" />
                                </Modal>

                                <Modal :show="isOpen" @close="closeModal2" maxWidth="lg">
                                    <RegistrarGastos />
                                </Modal>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
