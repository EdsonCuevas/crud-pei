<script setup>
import AuthenticatedLayout from '@/Layouts/Volunt/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Gastos from '@/Components/Gastos.vue';

import {ref} from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    expenses: {
		type: Array
	},
});
const showModal = ref(false);

const selectedExpense = ref(null);  // Almacenamos el gasto seleccionado

const openModalView = (expense) => {
  showModal.value = true;
  selectedExpense.value = expense; // Asignamos el gasto seleccionado
};

const closeModal = () => {
  showModal.value = false;
};

</script>

<template>
	<Head title="Expenses" />
	
	<AuthenticatedLayout>
		
	    <template #header>
		Expenses
	    </template>

		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Value</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">Origen</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="expense in expenses" :key="expense.id" class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
									{{ expense.id }}
								</td>
								<td class="px-4 py-3 text-sm">
									${{ expense.value }}MXN
								</td>
                                <td class="px-4 py-3 text-sm">
                                    {{ expense.reason }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ expense.program.title }}
                                </td>
								<td class="px-4 py-3 text-sm">
                                    {{ new Date(expense.created_at).toLocaleString() }}
                                </td>
                                
                                <td class="px-4 py-3 text-sm">
                                    <!-- Modal para Confirmar la Donación -->
          

                            <SecondaryButton @click="openModalView(expense)">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                            width="20" 
                            height="20" 
                            viewBox="0 0 24 24"
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="lucide lucide-receipt"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"/>
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 17.5v-11"/></svg>
                            </SecondaryButton>
                            <Modal :show="showModal" @close="closeModal" maxWidth="lg">
                                <Gastos :expense="selectedExpense"/>
                            </Modal>
                                </td>
							</tr>
                    </tbody>
                </table>
            </div>
		</div>  
	</AuthenticatedLayout>
</template>