<script setup>
import AuthenticatedLayout from '@/Layouts/Volunt/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref, computed } from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    users: {
        type: Array
    },
    usuario: Object,
});

const v = ref({
    name: '',
    photo: '',
});

const searchQuery = ref("");
const showModalView = ref(false);

const openModalView = (a) => {
    v.value.name = a.name;
    v.value.photo = a.photo;
    showModalView.value = true;
};

const closeModalView = () => {
    showModalView.value = false;
};

// Computed para filtrar contactos según la búsqueda
const filteredContactos = computed(() => {
    if (!searchQuery.value) {
        return props.users;
    }
    return props.users.filter(user => {
        const searchLower = searchQuery.value.toLowerCase();
        return (
            (user.name && user.name.toLowerCase().includes(searchLower)) || 
            (user.email && user.email.toLowerCase().includes(searchLower)) ||
            (user.phone && user.phone.toLowerCase().includes(searchLower)) ||
            (user.id && String(user.id).toLowerCase().includes(searchLower)) ||
            (user.role.role && user.role.role.toLowerCase().includes(searchLower))
        );
    });
});

// Computed para verificar si no se encontraron resultados
const noResultsFound = computed(() => {
    return filteredContactos.value.length === 0 && searchQuery.value !== '';
});
</script>

<template>
    <Head title="Contacts" />

    <AuthenticatedLayout>
        <template #header>
		Contacts
	    </template>
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by name, e-mail, phone or role..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>

        <!-- Mostrar mensaje de error si no se encuentran resultados -->
        <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
            No results found for "{{ searchQuery }}".
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Photo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="contacto in filteredContactos" :key="contacto.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="'mailto:' + contacto.email" class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 40 40">
                                    <path fill="#dff0fe" d="M4,34.5c-1.378,0-2.5-1.122-2.5-2.5V9c0-1.378,1.122-2.5,2.5-2.5h32c1.378,0,2.5,1.122,2.5,2.5v23 c0,1.378-1.122,2.5-2.5,2.5H4z"></path><path fill="#4788c7" d="M36,7c1.103,0,2,0.897,2,2v23c0,1.103-0.897,2-2,2H4c-1.103,0-2-0.897-2-2V9c0-1.103,0.897-2,2-2H36 M36,6H4C2.343,6,1,7.343,1,9v23c0,1.657,1.343,3,3,3h32c1.657,0,3-1.343,3-3V9C39,7.343,37.657,6,36,6L36,6z"></path><path fill="#b6dcfe" d="M38,32V9c0-1.105-0.895-2-2-2H4C2.895,7,2,7.895,2,9l18.772,25H36C37.105,34,38,33.105,38,32z"></path><path fill="#fff" d="M38,32V10.715L5,34h31C36.748,34,38,33.205,38,32z"></path><path fill="#dff0fe" d="M20.772,34H36c1.105,0,2-0.895,2-2V10.715l-22.69,16.01L20.772,34z"></path><path fill="#98ccfd" d="M4,34.5c-1.378,0-2.5-1.122-2.5-2.5V9.5h3v25H4z"></path><path fill="#4788c7" d="M4,10v24c-1.103,0-2-0.897-2-2V10H4 M5,9H1v1v22c0,1.657,1.343,3,3,3h1V9L5,9z"></path><path fill="#98ccfd" d="M35.5,34.5v-25h3V32c0,1.378-1.122,2.5-2.5,2.5H35.5z"></path><path fill="#4788c7" d="M38,10v22c0,1.103-0.897,2-2,2V10H38 M39,9h-4v26h1c1.657,0,3-1.343,3-3V9L39,9z"></path><path fill="#fff" d="M2.6,10.564c-0.288-0.201-1.1-0.91-1.1-1.542C1.5,7.622,2.622,6.5,4,6.5h32 c1.378,0,2.5,1.122,2.5,2.5c0,0.654-0.812,1.364-1.097,1.563L20,22.881L2.6,10.564z"></path><path fill="#4788c7" d="M36,7c1.103,0,2,0.897,2,2.024c0,0.326-0.523,0.876-0.889,1.134L20,22.269L2.884,10.153 C2.523,9.898,2,9.349,2,9c0-1.103,0.897-2,2-2h16H36 M36,6H20H4C2.343,6,1,7.343,1,9v0.023c0,1.042,1.311,1.95,1.311,1.95 L20,23.494l17.689-12.52c0,0,1.311-0.909,1.311-1.95V9C39,7.343,37.657,6,36,6L36,6z"></path><g><path fill="#98ccfd" d="M2.6,10.564c-0.109-0.081-0.227-0.173-0.364-0.3c-0.261-0.243-0.465-0.497-0.589-0.731 C1.549,9.349,1.5,9.178,1.5,9.022c0-0.986,0.569-1.864,1.438-2.273L20,18.827L37.063,6.75C37.932,7.159,38.5,8.035,38.5,9 c0,0.101-0.012,0.183-0.037,0.269c-0.164,0.568-0.821,1.127-1.06,1.295L20,22.881L2.6,10.564z"></path><path fill="#4788c7" d="M2.905,7.339L19.422,19.03L20,19.439l0.578-0.409L37.095,7.34C37.65,7.704,38,8.329,38,9.024 c0,0.03-0.006,0.066-0.017,0.106c-0.113,0.391-0.633,0.86-0.871,1.028L20,22.269L2.855,10.132C2.8,10.09,2.697,10.01,2.578,9.899 c-0.221-0.206-0.39-0.414-0.49-0.601C2.031,9.191,2,9.093,2,9C2,8.324,2.35,7.703,2.905,7.339 M3.003,6.183 C1.839,6.595,1,7.695,1,9v0.023c0,0.26,0.082,0.513,0.205,0.744c0.184,0.347,0.461,0.649,0.691,0.864 c0.154,0.143,0.287,0.248,0.358,0.301c0.036,0.027,0.056,0.041,0.056,0.041L20,23.494l17.689-12.52c0,0,1.004-0.696,1.255-1.568 C38.979,9.282,39,9.154,39,9.024V9c0-1.305-0.838-2.404-2.002-2.817L20,18.214L3.003,6.183L3.003,6.183z"></path></g>
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="'https://api.whatsapp.com/send?phone=521' + contacto.phone + '&text=Hola%20soy%20'+ usuario.name +'%20de%20la%20Fundación%20CTI'" class="inline-block" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 128 128">
                                    <path fill="#fff" d="M64,123c32.5,0,59-26.5,59-59c0-15.8-6.1-30.6-17.3-41.7C94.6,11.1,79.8,5,64,5C31.5,5,5,31.4,5,64 c0,10.4,2.7,20.5,7.9,29.5l-5.6,20.6c-1.2,4.4,2.8,8.5,7.3,7.3l21.3-5.6C44.4,120.5,54.1,123,64,123L64,123z"></path><path fill="#444b54" d="M107.9,20.2C96.2,8.5,80.6,2,64,2C29.8,2,2,29.8,2,64c0,10.5,2.6,20.8,7.7,29.9l-5.3,19.4 c-0.9,3.1,0,6.3,2.3,8.6c2.3,2.3,5.5,3.2,8.6,2.4l20.2-5.3c8.8,4.6,18.6,7,28.6,7c34.2,0,62-27.8,62-62 C126,47.5,119.6,31.9,107.9,20.2z M64,120c-9.3,0-18.6-2.4-26.8-6.8c-0.4-0.2-0.9-0.4-1.4-0.4c-0.3,0-0.5,0-0.8,0.1l-21.3,5.6 c-1.5,0.4-2.5-0.4-2.9-0.8c-0.4-0.4-1.2-1.4-0.8-2.9l5.6-20.6c0.2-0.8,0.1-1.6-0.3-2.3C10.5,83.5,8,73.8,8,64C8,33.1,33.1,8,64,8 c15,0,29.1,5.8,39.6,16.4C114.2,35,120.1,49.1,120,64C120,94.9,94.9,120,64,120z"></path><g><path fill="#71c2ff" d="M97.3,30.7C88.4,21.9,76.6,17,64,17C38.1,17,17,38,17,64c0,8.3,2.2,16.4,6.3,23.5c1.6,2.8,2,6.1,1.2,9.2 l-2.9,10.5l11.2-2.9c1-0.3,2-0.4,3-0.4c2,0,4,0.5,5.7,1.5C48.4,109,56.1,111,64,111h0c25.9,0,47-21.1,47-47 C111,51.4,106.1,39.6,97.3,30.7z M92.9,85.1c-1.2,3.4-7.2,6.8-10,7c-2.7,0.2-5.2,1.2-17.7-3.7c-15-5.9-24.5-21.3-25.2-22.3 c-0.7-1-6-8-6-15.3c0-7.3,3.8-10.8,5.2-12.3c1.4-1.5,2.9-1.8,3.9-1.8c1,0,2,0,2.8,0c1.1,0,2.2,0.1,3.3,2.5 c1.3,2.9,4.2,10.2,4.5,10.9c0.4,0.7,0.6,1.6,0.1,2.6c-0.5,1-0.7,1.6-1.5,2.5c-0.7,0.9-1.6,1.9-2.2,2.6c-0.7,0.7-1.5,1.5-0.6,3 c0.9,1.5,3.8,6.3,8.2,10.2c5.6,5,10.4,6.6,11.9,7.3c1.5,0.7,2.3,0.6,3.2-0.4c0.9-1,3.7-4.3,4.7-5.8c1-1.5,2-1.2,3.3-0.7 c1.4,0.5,8.6,4.1,10.1,4.8c1.5,0.7,2.5,1.1,2.8,1.7C94.1,78.7,94.1,81.6,92.9,85.1z"></path></g>
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ contacto.role.role }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <button @click="openModalView(contacto)">
                                    <img :src="contacto.photo ? `../../storage/img/profile/${contacto.photo}` : '../../storage/img/profile/profile-icon.png'"
                                        alt="Imagen de perfil" class="object-cover rounded-full w-[50px]" />
                                </button>
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
    </AuthenticatedLayout>
</template>
