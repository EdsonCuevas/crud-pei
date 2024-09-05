<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Dashboard" />
	
	<AuthenticatedLayout>
		<template #header>
			Perfil Personal
		</template>
		
		<div class="p-4 bg-white rounded-lg shadow-xs">
			Hola {{ $page.props.auth.user.name }}! <br>
			Hola {{ $page.props.auth.user.name }}!
		</div>
		
	</AuthenticatedLayout>
</template>
