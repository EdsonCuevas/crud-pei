<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import getEdad from '@/Utils/getEdad.js';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    coordinadores: {
        type: Array
    },
    roles: {
        type: Object
    }
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    birthdate: '',
    rfc: '',
    password: '',
    role_id: ''
});

const v = ref({
    id: '',
    name: '',
    phone: '',
    rfc: '',
    birthdate: '',
    password: '',
    photo: '',
});

const showModalView = ref(false);
const showModalForm = ref(false);
const title = ref('');
const operation = ref(1);

const openModalView = (a) => {
    v.value.name = a.name;
    v.value.photo = a.photo;
    showModalView.value = true;
};

const openModalForm = (op, a) => {
    showModalForm.value = true;
    operation.value = op;
    form.clearErrors();
    if (op === 1) {
        title.value = 'Create Coordinator';
    } else {
        title.value = 'Edit Coordinator';
        form.name = a.name;
        form.email = a.email;
        form.password = '';
        form.role_id = a.role_id;
        form.phone = a.phone;
        form.birthdate = a.birthdate;
        form.rfc = a.rfc;
        v.value.id = a.id;
    }
};

const closeModalView = () => {
    showModalView.value = false;
};
const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
};

const save = () => {
    if (!form.password) {
        delete form.password;
    }

    if (operation.value === 1) {
        form.post(route('admin-coordinators.store'), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Created!',
                    text: 'Coordinator created successfully!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                closeModalForm();
            },
        });
    } else {
        form.put(route('admin-coordinators.update', v.value.id), {
            onSuccess: () => {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Coordinator updated successfully!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                closeModalForm();
            },
        });
    }
};

const deleteCoordi = (coordinator) => {
    Swal.fire({
        title: 'Are you sure?',
        text: `You won't be able to revert this! Deleting Coordinator: ${coordinator.name}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'


    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('admin-coordinators.destroy', coordinator.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Delete',
                        text: 'Coordinator delete successfully!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    closeModalForm();
                },
            });
        }
    });
};

const exportUsers = () => {
    window.location.href = '/export/2';
};
// Variable para almacenar la consulta de búsqueda
const searchQuery = ref("");

const filteredCoordinadores = computed(() => {
    if (!searchQuery.value) {
        return props.coordinadores;
    }
    return props.coordinadores.filter(coordi => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (coordi.id && String(coordi.id).toLowerCase().includes(searchLower)) ||
            (coordi.name && coordi.name.toLowerCase().includes(searchLower)) ||
            (coordi.email && coordi.email.toLowerCase().includes(searchLower)) ||
            (coordi.rfc && coordi.rfc.toLowerCase().includes(searchLower)) ||
            (coordi.phone && coordi.phone.toLowerCase().includes(searchLower)) ||
            (coordi.birthdate && String(coordi.birthdate).toLowerCase().includes(searchLower))
        );
    });
});
const noResultsFound = computed(() => {
    return filteredCoordinadores.value.length === 0 && searchQuery.value !== '';
});
</script>

<template>

    <Head title="Coordinators" />

    <AuthenticatedLayout>
        <template #header>
            Coordinators
            <br>
            <br>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <button @click="openModalForm(1)"
                    class="w-20 bg-gradient-to-r py-2 from-[#004481] to-[#1464A5] text-white font-bold rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481] flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                </button>

                <button @click="exportUsers"
                    style="background-color: white; border: 2px solid green; padding: 10px; border-radius: 8px;">
                    <img src="storage/img/EXLG.png" style="width: 24px; height: 24px;">
                </button>
            </div>
        </template>

        <div class="mb-6 relative" style="width: 500px;">
            <input v-model="searchQuery" type="text" placeholder="Search by #, name, email, phone, rfc or age..."
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

        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">RFC</th>
                            <th class="px-4 py-3">Age</th>
                            <th class="px-4 py-3">Photo</th>
                            <th class="px-4 py-3">Edit</th>
                            <th class="px-4 py-3">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="coordi in filteredCoordinadores" :key="coordi.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ coordi.id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ coordi.name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ coordi.email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ coordi.phone }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ coordi.rfc }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ getEdad(coordi.birthdate) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <button @click="openModalView(coordi)">
                                    <img :src="coordi.photo ? `../../storage/img/profile/${coordi.photo}` : '../../storage/img/profile/profile-icon.png'"
                                        alt="Imagen de perfil" class="object-cover rounded-full w-[50px]" />
                                </button>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <WarningButton @click="openModalForm(2, coordi)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="deleteCoordi(coordi)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <Modal :show="showModalView" @close="closeModalView">
            <div class="p-6">
                <div class="flex flex-col items-center">
                    <h3 class="text-lg font-medium text-gray-900">{{ v.name }}</h3>
                    <!-- Mostrar imagen de perfil si existe -->
                    <img v-if="v.photo" :src="`../../storage/img/profile/${v.photo}`" alt="Coordinator Photo"
                        class="w-96 rounded-full object-cover mb-4" />
                    <!-- Mostrar imagen por defecto si no existe -->
                    <img v-else :src="`../../storage/img/profile/profile-icon.png`" alt="Default Photo"
                        class="w-96 rounded-full object-cover mb-4" />

                </div>
            </div>
            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
            </div>
        </Modal>


        <Modal :show="showModalForm" @close="closeModalForm">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
                <div class="mt-6 mb-6 space-y-6 max-w-xl">
                    <InputGroup :text="'Name'" :required="'required'" v-model="form.name" :type="'text'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.name"></InputError>

                    <InputGroup :text="'E-mail'" :required="'required'" v-model="form.email" :type="'email'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.email"></InputError>

                    <InputGroup :text="'Password'" :required="'required'" v-model="form.password" :type="'password'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.password"></InputError>

                    <SelectInput v-if="operation !== 1" :required="'required'" v-model="form.role_id" :options="roles">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </SelectInput>
                    <InputError class="mt-1" :message="form.errors.role_id"></InputError>

                    <InputGroup :text="'Phone'" :required="'required'" v-model="form.phone">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.phone"></InputError>

                    <InputGroup :text="'Fecha de Usuario'" v-model="form.birthdate" :type="'date'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.birthdate"></InputError>

                    <InputGroup :text="'RFC'" v-model="form.rfc">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.rfc"></InputError>

                </div>
            </div>
            <div class="m-6 flex justify-between">
                <PrimaryButton @click="save">Save</PrimaryButton>
                <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
