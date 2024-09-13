<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Programas" />
	
	<AuthenticatedLayout>
		<template #header>
			Programas
		</template>
		
		<div class="p-4 bg-white rounded-lg shadow-xs">
			Sample static text page
		</div>
	</AuthenticatedLayout>
</template>
