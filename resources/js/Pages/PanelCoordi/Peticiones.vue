<script setup>
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'; // Import SweetAlert2
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';

// Props received from the controller
const props = defineProps({
    Programas: Array,
});

// Initialize the Inertia form
const form = useForm({ userId: null, programId: null });

const acceptRequest = (userId, programId) => {
    // Show confirmation modal with SweetAlert2
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, set values and send POST request
            form.userId = userId;
            form.programId = programId;
            form.post(route('coordpeticiones.accept'));

            // Show success toast notification with SweetAlert2
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: "Successfully approved"
            });
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            Requests

            <br>
        </template>
            <div class="w-full overflow-hidden rounded-lg border shadow-md">
                <div class="w-full overflow-x-auto bg-white">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Program</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Approve</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <template v-for="(programa, index) in Programas" :key="index">
                                <tr v-for="(user, userIndex) in programa.users" :key="userIndex" class="text-gray-700">
                                    <td class="px-4 py-3 text-sm">{{ user.name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ programa.title }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span v-if="user.pivot.approved === 1" class="text-green-500 font-semibold">Approved</span>
                                        <span v-else class="text-red-500 font-semibold">Pending</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <SecondaryButton @click="acceptRequest(user.id, programa.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </SecondaryButton>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
    </AuthenticatedLayout>
</template>
