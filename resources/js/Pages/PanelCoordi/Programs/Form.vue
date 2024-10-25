<script setup>
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputGroup from '@/Components/InputGroup.vue';
import { ref } from 'vue';
import Select2 from 'vue3-select2-component';
import Swal from 'sweetalert2';

import { Type, Text, ImagePlus, UserSearch } from 'lucide-vue-next';

const props = defineProps({
    program: { type: Object },
    users: { type: Object },
    benefsDelPrograma: { type: Object }
});

const form = useForm({
    id: '', title: '', description: '', image: '', coordi_id: '', beneficiaries: [],
});

const title_form = ref(
    (props.program == null) ? 'Create Program' : 'Edit Program'
);
const req = ref('required');
const srcImg = ref('../../storage/img/example.jpg');

const options = ref([]);
props.users.map((row) => (
    options.value.push({ 'id': row.id, 'text': row.name })
));

if (props.program != null) {
    form.id = props.program.id;
    form.title = props.program.title;
    form.description = props.program.description;
    form.coordi_id = props.program.coordi_id;
    form.image = props.program.image;
    srcImg.value = '../../storage/img/' + props.program.image;
    props.benefsDelPrograma.map((row) => (
        form.beneficiaries.push(row.id)
    ));
}

const save = () => {
    if (props.program == null) {
        form.post(route('coord-programs.store'), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Created!',
                    text: 'Program created successfully!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            onError: () => {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error creating the program',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    } else {
        form.post(route('coord-programs.update', form.id), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Program updated successfully!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            onError: () => {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error updating the program',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
};

const showImg = (e) => {
    form.image = e.target.files[0];
    srcImg.value = URL.createObjectURL(e.target.files[0]);
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Program" />
        <div class="min-h-screen bg-gradient-to-b to-white">
            <div class="container mx-auto">
                <div class="bg-green-500 text-white p-6">
                    <h2 class="text-3xl font-semibold">{{ title_form }}</h2>
                    <p class="text-green-100">Education support program</p>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <form class="mt-6 mb-6 space-y-6 max-w-xl" @submit.prevent="save">
                            <InputGroup :text="'Program Title'" :required="'required'" v-model="form.title">
                                <Type />
                            </InputGroup>
                            <InputError :message="form.errors.title" />

                            <InputGroup :text="'Description'" :required="'required'" v-model="form.description">
                                <Text />
                            </InputGroup>
                            <InputError :message="form.errors.description" />

                            <InputGroup v-if="props.program == null" @change="showImg($event)" :text="'Image'" :required="'required'" :type="'file'" :accept="'image/*'">
                                <ImagePlus />
                            </InputGroup>
                            
                            <InputGroup v-else :text="'Image'" @change="showImg($event)" :type="'file'" :accept="'image/*'">
                                <ImagePlus />
                            </InputGroup>

                            <InputError :message="form.errors.image" />
                            <br>
                            <span class="mt-2">Beneficiaries:</span>
                            <Select2 v-model="form.beneficiaries" :options="options" :settings="{multiple:true, width:'100%'}" @change="form.beneficiaries = $event.target.value" />
                            <InputError :message="form.errors.beneficiaries" />

                            <PrimaryButton>Save</PrimaryButton>
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
