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
                                <a :href="'mailto:' + contacto.email" class="text-blue-500 hover:underline">
                                    {{ contacto.email }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="'https://api.whatsapp.com/send?phone=521' + contacto.phone + '&text=Hola%20soy%20'+ usuario.name +'%20de%20la%20Fundación%20CTI'" class="text-blue-500 hover:underline" target="_blank">
                                    {{ contacto.phone }}
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
