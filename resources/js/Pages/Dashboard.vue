<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Profile/Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Profile/Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
	<Head title="Profile" />
	
	<AuthenticatedLayout>
		<template #header>
			Perfil
	</template>
		
		<div class="sm:px-6 md:px-0 lg:px-0 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<UpdateProfileInformationForm
					:must-verify-email="mustVerifyEmail"
					:status="status"
					class="max-w-xl"
				/>
			</div>
			
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<UpdatePasswordForm class="max-w-xl" />
			</div>
			
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<DeleteUserForm class="max-w-xl" />
			</div>
		</div>
	</AuthenticatedLayout>
</template>
