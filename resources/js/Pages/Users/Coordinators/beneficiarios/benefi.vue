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
        title.value = 'Crear Beneficiarios';
    }
    else{
        title.value = 'Editar Beneficiarios';
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
            onSuccess: () => ok('Beneficiado Creado'),
        });
    } else {
        form.put(route('beneficiaries.update', v.value.id), {
            onSuccess: () => ok('Beneficiado Actualizado'),
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
	<Head title="Beneficiarios" />
	
	<AuthenticatedLayout>
		<template #header>
			Recursos
            <br>
            <br>
            <DarkButton @click="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </DarkButton>
		</template>
        <br>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Por</th>
                            <th class="px-4 py-3">Fecha de Publicacion</th>
                            <th class="px-4 py-3">Fecha de Actualizacion</th>                             
                            <th class="px-4 py-3">Acciones</th>
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
									{{ benefi.phone }}
								</td>
                                <td class="px-4 py-3 text-sm">
									{{ benefi.phone }}
								</td>
                                <td class="px-4 py-3 text-sm">
									{{ benefi.phone }}
								</td>
							</tr>
                    </tbody>
                </table>
            </div>
		</div>
        <Modal :show="showModalView" @close="closeModalView">
            <div class="p-6">
                Tu pefil:
                <ol>
                    <li class="text-lg font-medium text-gray-900" v-for="b,i in v.programs">
                        {{ (i+1)+') '+ b.name }}
                    </li>
                </ol>
            </div>
            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
            </div>
        </Modal>
        
        <Modal :show="showModalForm" @close="closeModalForm">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
                <div class="mt-6 mb-6 space-y-6 max-w-xl">
                    <InputGroup :text="'Nombre'" :required="'required'" v-model="form.name" :type="'text'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.name"></InputError>

                    <InputGroup :text="'Email'" :required="'required'" v-model="form.email" :type="'text'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.email"></InputError>

                    <InputGroup :text="'Password'" :required="'required'" v-model="form.password" :type="'password'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.password"></InputError>

                    <InputGroup :text="'Telefono'" :required="'required'" v-model="form.phone">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.phone"></InputError>
                    
                    <InputError class="mt-1" :message="form.errors.image"></InputError>
                </div>
            </div>
            <div class="m-6 flex justify-between">
                <PrimaryButton @click="save">Guardar</PrimaryButton>
                <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
            </div>
        </Modal>

        <Modal :show="showModalDel" @close="closeModalDel">
            <div class="p-6">

            </div>
        </Modal>
	</AuthenticatedLayout>
</template>