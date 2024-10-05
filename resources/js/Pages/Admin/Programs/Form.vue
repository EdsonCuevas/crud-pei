<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayoutProgram.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import SelectInputProgram from '@/Components/SelectInput.vue';
import InputGroup from '@/Components/InputGroup.vue';
import {ref} from 'vue';

import { Type, Text, ImagePlus, UserSearch } from 'lucide-vue-next';

const props = defineProps({
    programas:{type:Object},
    program:{type:Object},
    creator:{type:Object},
    coordinators:{type:Object},
    users:{type:Object}
});

const form = useForm({
    id:'', title:'', description:'', image:'', creator_id:'', coordi_id:'', beneficiaries:[],
});

const title_form = ref(
    (props.program == null) ? 'Crear Programa' : 'Editar Programa'
);
const req = ref('required');
const srcImg = ref('../../storage/img/example.jpg');

const msj = ref('');
const classMsj = ref('hidden');

if(props.program != null){
    form.id = props.program.id;
    form.title = props.program.title;
    form.description = props.program.description;
    form.image = props.program.image;
    srcImg.value = '../../storage/img/'+props.program.image;
}

const save = () => {
    console.log(form.title);
    if(props.program == null){
        form.post(route('admin-programs.store'),{
            onSuccess: () => {ok('Programa Creado')}
        });
    }
    else {
        form.post(route('updateprogram'))
    }
}

const ok = (m) => {
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
    setTimeout(() => {
        classMsj.value = 'hidden';
    }, 7000)
}

const showImg = (e) => {
    form.image = e.target.files[0];
    srcImg.value = URL.createObjectURL(e.target.files[0]);

}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Programa" />
        <div class="min-h-screen bg-gradient-to-b to-white">
            <div class="container mx-auto">
                <div class="bg-blue-500 text-white p-6">
                    <h2 class="text-3xl font-semibold">{{ title_form }}</h2>
                    <p class="text-blue-100">Programa de apoyo educativo</p>
                </div>

                <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
                    <div class="flex justify-center items-center w-12 bg-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <div class="px-4 py-2 mx-3">
                        <div class="mx-3">
                            <span class="font-semibold text-green-500">Exito</span>
                            <p class="text-sm text-gray-600">{{ msj }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <form class="mt-6 mb-6 space-y-6 max-w-xl" @submit.prevent="save">
                            <InputGroup :text="'Titulo Del Programa'" :required="'required'" v-model="form.title">
                                <Type />
                            </InputGroup>
                            <InputError :message="form.errors.title" />

                            <InputGroup :text="'Descripción'" :required="'required'" v-model="form.description">
                                <Text />
                            </InputGroup>
                            <InputError :message="form.errors.description" />

                            <div class="relative text-gray-500 focus-within:text-blue-500">
                                
                                <select class="rounded block w-full pl-10 mt-1 text-sm text-black focus:border-blue-400 focus:outline-none focus:shadow-outline-purple form-input" 
                                :required="required" v-model="form.coordi_id">
                                    <option v-for="coordi in coordinators" :key="coordi.id" :value="coordi.id">
                                        {{ coordi.name }}
                                    </option>
                                </select> 
                                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                    <UserSearch />
                                </div>
                            </div>
                            <InputError :message="form.errors.coordi_id" />

                            <InputGroup v-if="props.program == null" @change="showImg($event)" :text="'Imagen'" :required="'required'" :type="'file'" :accept="'image/*'">
                                <ImagePlus />
                            </InputGroup>
                            
                            <InputGroup v-else :text="'Imagen'" @change="showImg($event)" :type="'file'" :accept="'image/*'">
                                <ImagePlus />
                            </InputGroup>

                            <InputError :message="form.errors.image" />
                            <PrimaryButton>Guardar</PrimaryButton>
                        </form>
                    </div>
                    <div class="win-w-0 p-4 rounded-lg shadow-xs">
                        <img :src="srcImg">
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
