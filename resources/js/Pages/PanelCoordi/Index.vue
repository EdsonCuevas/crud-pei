<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {ref} from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    Programas: {
		type: Array
	},
});

</script>

<template>
	<Head title="Coordinadores" />
	
	<AuthenticatedLayout>
		<template #header>
			Programas
            <br>
		</template>
        
        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
            <div class="flex justify-center items-center w-12 bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            
           
            
        </div>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Titulo</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Fecha de Creación</th>
                            <th class="px-4 py-3">Fecha de Modificación</th>
                            <th class="px-4 py-3">Asignado por:</th>
                            <th class="px-4 py-3">Gestionar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="programa in Programas" :key="programa.id" class="text-gray-700">
                                
								<td class="px-4 py-3 text-sm">
									{{ programa.name }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ programa.description }}
								</td>
								<td class="px-4 py-3 text-sm">
                                    {{ new Date(programa.created_at).toLocaleString() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ new Date(programa.updated_at).toLocaleString() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <WarningButton>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </WarningButton>
                                </td>
							</tr>
                    </tbody>
                </table>
            </div>
		</div>
	</AuthenticatedLayout>
</template>