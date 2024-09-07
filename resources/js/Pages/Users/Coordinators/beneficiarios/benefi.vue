<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

import {ref} from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    beneficiarios: {
		type: Array
	},
});
const form = useForm({
     name:'',
     email:'',
     phone:'',
     password:'',
});

const v = ref({
    id:'',
    name:'',
    phone:'',
    password:'',
    programs:[]
});

const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (a) => {
    v.value.name = a.name;
    v.value.phone = a.phone;
    v.value.programs = a.programs;
    showModalView.value = true;
}
const openModalForm = (op,a) => {
    showModalForm.value = true;
    operation.value = op;
    if(op === 1){
        title.value = 'Crear Beneficiario';
    }
    else{
        title.value = 'Editar Beneficiario';
        form.name = a.name;
        form.email = a.email;
        form.password = '';
        form.phone = a.phone;
        v.value.id = a.id;
    }
}
const openModalDel = () => {
    showModalDel.value = true;
}

const closeModalView = () => {
    showModalView.value = false;
}
const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
}
const closeModalDel = () => {
    showModalDel.value = false;
}

const save = () => {
    if (operation.value === 1) {
        form.post(route('beneficiaries.store'), {
            onSuccess: () => ok('Beneficiario Creado'),
        });
    } else {
        form.put(route('beneficiaries.update', v.value.id), {
            onSuccess: () => ok('Beneficiario Actualizado'),
        });
    }
};

const ok = (m) => {
    if(operation.value == 2){
        closeModalForm();
    }
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
}

</script>

<template>
	<Head title="Beneficiario" />
	
	<AuthenticatedLayout>
		<template #header>
			Recursos
            <br>
            <br>
            <!--
            <DarkButton @click="openModalForm(1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </DarkButton>
            -->
		</template>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Beca</th>
                            <th class="px-4 py-3">Administrado<br>por</th>
                            <th class="px-4 py-3">Fecha de Publicacion</th>
                            <th class="px-4 py-3">Fecha de Actualización</th>
                            <th class="px-4 py-3">Detalles</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="benefi in beneficiarios" :key="benefi.id" class="text-gray-700">  
								<td class="px-4 py-3 text-sm">
									{{ benefi.name }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ benefi.email }}
								</td>
								<td class="px-4 py-3 text-sm">
                                    {{ new Date(benefi.created_at).toLocaleString() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ new Date(benefi.updated_at).toLocaleString() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <SecondaryButton @click="openModalView(benefi)">
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
        <Modal :show="showModalView" @close="closeModalView">
            <div class="p-6">
                Informacion de la Beca:
                <ol>
                    <li class="text-lg font-medium text-gray-900" v-for="b,i in v.programs">
                        {{ (i+1)+') '+ b.name }}
                    </li>
                </ol>
            </div>
            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Cerrar</SecondaryButton>
            </div>
        </Modal>

        <Modal :show="showModalDel" @close="closeModalDel">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">¿Estás seguro que quieres eliminar la beca?</h2>
                <table class="w-full whitespace-no-wrap mb-4">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Beca</th>
                            <th class="px-4 py-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="benefi in beneficiarios" :key="benefi.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ benefi.name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-right">
                                <DangerButton @click="openModalDel">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <ol class="list-decimal list-inside text-lg font-medium text-gray-900">
                    <li v-for="(b, i) in v.programs" :key="i">
                        {{ (i + 1) + ') ' + b.name }}
                    </li>
                </ol>
            </div>

            <div class="p-6 flex justify-end">
                <SecondaryButton @click="closeModalDel">Cerrar</SecondaryButton>
            </div>
        </Modal>
	</AuthenticatedLayout>
</template>