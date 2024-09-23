<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
	email: '',
	password: '',
	remember: false
});

const submit = () => {
	form.post(route('login'), {
		onFinish: () => form.reset('password'),
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Log in" />
		
		<div class="flex flex-col overflow-y-auto md:flex-row">
			<div class="h-32 md:h-auto md:w-1/2">
				<img aria-hidden="true" class="object-cover w-full h-full" src="/images/login-office.jpeg" alt="Office" />
			</div>
			<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
				<div class="w-full">
					<h1 class="mb-4 text-xl font-semibold text-gray-700">Login</h1>
					
					<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
						{{ status }}
					</div>
					
					<form @submit.prevent="submit" />
						<div class="mt-4">
							<InputLabel for="email" value="Correo electronico" />
							<TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus autocomplete="username" />
							<InputError class="mt-2" :message="form.errors.email" />
						</div>
						
						<div class="mt-4">
							<InputLabel for="password" value="Contraseña" />
							<TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required autocomplete="current-password" />
							<InputError class="mt-2" :message="form.errors.password" />
						</div>
						
						<div class="block mt-4">
							<label class="flex items-center">
								<Checkbox name="remember" v-model:checked="form.remember" />
								<span class="ml-2 text-sm text-gray-600">Recuerdame</span> </label>
						</div>
						
						<div class="flex items-center justify-end mt-4">
							<Link :href="route('register')" class="text-sm  text-gray-600 underline hover:text-gray-900 mr-10">
								Registrarse
							</Link> 
							<Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 underline  hover:text-gray-900">
								¿Olvidaste tu contraseña?
							</Link>
							<!-- Link que redirige a la página de registro --> 
							
							
							<PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Iniciar Sesión
							</PrimaryButton>
						</div>
						</div>
					
				</div>
			</div>
	</GuestLayout>
</template>
