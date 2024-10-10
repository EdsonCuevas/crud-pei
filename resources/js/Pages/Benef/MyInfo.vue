<script setup>
import AuthenticatedLayout from '@/Layouts/Benef/AuthenticatedLayout.vue';
import ProfileInformationPerfil from '../Profile/Partials/ProfileInformationPerfil.vue';
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
			Profile
		</template>
		
		<div class="sm:px-6 md:px-0 lg:px-0 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<ProfileInformationPerfil
					:must-verify-email="mustVerifyEmail"
					:status="status"
					class="max-w-xl"
				/>
			</div>
			

		</div>
	</AuthenticatedLayout>
</template>
