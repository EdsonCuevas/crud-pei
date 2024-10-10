<script setup>
import AuthenticatedLayout from '@/Layouts/Benef/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {ref} from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    programas: {
		type: Array
	},
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

</script>


<template>
	<Head title="Beneficiario" />
	
	<AuthenticatedLayout>
		<template #header>
			Resources
            <br>
            <br>
		</template>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Program</th>
                            <th class="px-4 py-3">Administered by</th>
                            <th class="px-4 py-3">Details</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="programa in programas" :key="programa.id" class="text-gray-700">  
								<td class="px-4 py-3 text-sm">
									{{ programa.title }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ programa.coordinator ? (programa.coordinator.name ? programa.coordinator.name : '') : '' }}
								</td>
                                <td class="px-4 py-3 text-sm">
                                    <SecondaryButton @click="openModalView(programa)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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
                <img v-if="selectedProgram.image" 
                 :src="`/storage/img/${selectedProgram.image}`" 
                 alt="Imagen del programa" 
                 class="mt-4 w-full h-[500px] rounded-lg">
            </div>
            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Close</SecondaryButton>
            </div>
        </Modal>
	</AuthenticatedLayout>
</template>
