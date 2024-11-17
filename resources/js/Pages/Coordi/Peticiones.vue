<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2'; // Import SweetAlert2
import SecondaryButtonGreen from '@/Components/SecondaryButtonGreen.vue';
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';

// Props received from the controller
const props = defineProps({
    Programas: Array,
});

// Initialize the Inertia form
const form = useForm({ userId: null, programId: null });

// Function to calculate the totals of approved and pending users
const calculateTotals = () => {
    let approvedCount = 0;
    let pendingCount = 0;

    // Loop through programs and users to count statuses
    props.Programas.forEach(programa => {
        programa.users.forEach(user => {
            if (user.pivot.approved === 1) {
                approvedCount++;
            } else {
                pendingCount++;
            }
        });
    });

    return { approvedCount, pendingCount };
};

let totals = calculateTotals();

// Function to accept a request and update the approval status locally
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
            // Find the program and the user
            const program = props.Programas.find(p => p.id === programId);
            const user = program.users.find(u => u.id === userId);

            // Update the user's approval status locally
            user.pivot.approved = 1;

            // Recalculate totals
            totals = calculateTotals();

            // Now, submit the approval to the backend
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

// Variable to store the search query
const searchQuery = ref("");

// Computed property to filter the programs based on the search query
const filteredProgramas = computed(() => {
    if (!searchQuery.value) {
        return props.Programas;
    }

    // Filter programs and users based on search query
    return props.Programas.filter(programa => {
        // Check if the search query matches either the user name or the program title
        const searchLower = searchQuery.value.toLowerCase();
        return programa.users.some(user => 
            user.name.toLowerCase().includes(searchLower) || 
            programa.title.toLowerCase().includes(searchLower)
        );
    });
});

// Check if the filtered result is empty
const noResultsFound = computed(() => {
    return filteredProgramas.value.length === 0 && searchQuery.value !== '';
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            Requests
            <br>

            <!-- Display totals here -->
            <div class="flex justify-between mt-4 text-sm text-gray-700">
                <div><strong>Total Pending: </strong>{{ totals.pendingCount }}</div>
            </div>

            <!-- Show error message if no results found -->
            <div v-if="noResultsFound" class="mt-2 text-red-500 text-sm">
                No results found for "{{ searchQuery }}".
            </div>
        </template>
        
        <div class="mb-6">
            <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Search by user or program..." 
                class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                style="width: 500px;" 
            />
        </div>

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
                        <template v-for="(programa, index) in filteredProgramas" :key="index">
                            <tr v-for="(user, userIndex) in programa.users" :key="userIndex" class="text-gray-700">
                                <td class="px-4 py-3 text-sm">{{ user.name }}</td>
                                <td class="px-4 py-3 text-sm">{{ programa.title }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span v-if="user.pivot.approved === 1" class="text-green-500 font-semibold">Approved</span>
                                    <span v-else class="text-red-500 font-semibold">Pending</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <SecondaryButtonGreen @click="acceptRequest(user.id, programa.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </SecondaryButtonGreen>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
