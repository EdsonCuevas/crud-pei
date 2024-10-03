<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayoutProgram.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputGroup from '@/Components/InputGroup.vue';
import {ref} from 'vue';

import { Type, Text, ImagePlus } from 'lucide-vue-next';

const props = defineProps({
    programas:{type:Object},
    program:{type:Object},
    creator:{type:Object},
    coordinator:{type:Object},
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
                <div class="p-6 grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <form class="mt-6 mb-6 space-y-6 max-w-xl">
                            <InputGroup :text="'Titulo Del Programa'" :required="'required'" v-model="form.title">
                                <Type />
                            </InputGroup>
                            <InputError :message="form.errors.title" />

                            <InputGroup :text="'Descripción'" :required="'required'" v-model="form.description">
                                <Text />
                            </InputGroup>
                            <InputError :message="form.errors.description" />

                            <InputGroup v-if="props.program == null" :text="'Imagen'" :required="'required'" v-model="form.image" :type="'file'" :accept="'image/*'">
                                <ImagePlus />
                            </InputGroup>
                            
                            <InputGroup v-else :text="'Imagen'" v-model="form.image" :type="'file'" :accept="'image/*'">
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
