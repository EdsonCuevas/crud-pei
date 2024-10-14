<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
	name: '',
	email: '',
	password: '',
	phone: '',
	password_confirmation: '',
	rfc: '',
	role: '',
	terms: false,
});

const submit = () => {
	form.post(route('register'), {
		onFinish: () => form.reset('password', 'password_confirmation'),
	});
};
</script>

<template>
	<GuestLayout>

		<Head title="Register" />

		<div class="flex flex-col overflow-y-auto md:flex-row">
			<div class="h-32 md:h-auto md:w-1/2">
				<img aria-hidden="true" class="object-cover w-full h-full" src="/images/create-account-office.jpeg"
					alt="Office" />
			</div>

			<div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
				<div class="w-full">
					<h1 class="mb-4 text-xl font-semibold text-gray-700">
						Create Account
					</h1>

					<form @submit.prevent="submit">
						<div>
							<InputLabel for="name" value="Name" />
							<TextInput id="name" type="text" class="block w-full mt-1" v-model="form.name" required
								autofocus autocomplete="name" />
							<InputError class="mt-2" :message="form.errors.name" />
						</div>

						<div class="mt-4">
							<InputLabel for="email" value="E-mail" />
							<TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required
								autocomplete="username" />
							<InputError class="mt-2" :message="form.errors.email" />
						</div>

						<div class="mt-4">
							<InputLabel for="phone" value="Phone" />
							<TextInput id="phone" type="tel" class="block w-full mt-1" v-model="form.phone" required autocomplete="tel" />
							<InputError class="mt-2" :message="form.errors.phone" />
						</div>

						<div class="mt-4">
							<InputLabel for="rfc" value="RFC" />
							<TextInput id="rfc" type="text" class="block w-full mt-1" v-model="form.rfc" required autocomplete="rfc" />
							<InputError class="mt-2" :message="form.errors.rfc" />
						</div>

						<div class="mt-4">
							<InputLabel for="password" value="Password" />
							<TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password"
								required autocomplete="new-password" />
							<InputError class="mt-2" :message="form.errors.password" />
						</div>

						<div class="mt-4">
							<InputLabel for="password_confirmation" value="Confirm your Password" />
							<TextInput id="password_confirmation" type="password" class="block w-full mt-1"
								v-model="form.password_confirmation" required autocomplete="new-password" />
							<InputError class="mt-2" :message="form.errors.password_confirmation" />
						</div>

						<div class="mt-4">
							<InputLabel for="role" value="Role" />
							<select id="role" class="block w-full mt-1" v-model.number="form.role" required>
								<option value="" disabled>Select role</option>
								<option value="2">Coordinator</option>
								<option value="3">Volunteer</option>
								<option value="4">Donor</option>
								<option value="5">Beneficiary</option>
							</select>
							<InputError class="mt-2" :message="form.errors.role" />
						</div>

						<div class="block mt-4">
							<label class="flex items-center">
								<Checkbox name="terms" required />
								<span class="ml-2 text-sm text-gray-600">Accept <a class="text-blue-600" href="terms-conditions">Terms & Conditions</a></span> </label>
						</div>

						<div class="flex items-center justify-end mt-4">
							<Link :href="route('login')" class="text-sm text-gray-600 underline  hover:text-gray-900">
								Already have an account?
							</Link>

							<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
								:disabled="form.processing">
								Sign up
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</GuestLayout>
</template>
