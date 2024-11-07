<script setup>
import AuthenticatedLayout from '@/Layouts/Volunt/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    users: {
		type: Array
	},
});

const searchQuery = ref("");

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


</script>

<template>
	<Head title="Voluntarios" />
	
	<AuthenticatedLayout>
		
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by #, name, phone, e-mail or role..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                style="width: 500px;" 
            />
        </div>
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Role</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="user in filteredContactos" :key="user.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ user.id }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ user.name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ user.phone }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ user.email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ user.role.role }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
	</AuthenticatedLayout>
</template>