<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    phone: user.phone,
    email: user.email,

});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Personal Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update the profile information and email address of your account.           </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            
            <!-- Subir imagen -->
            <div>
                <InputLabel for="image" value="Image" />
                    <p class="mt-1 block w-full">{{ form.image }}</p>
                <InputError class="mt-2" :message="form.errors.image" />
            </div>            
            
            <!-- Nombre -->
            <div>
                <InputLabel for="name" value="Name" />

                    <p class="mt-1 block w-full">{{ form.name }}</p>

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="E-mail" />
                    <p class="mt-1 block w-full">{{ form.email }}</p>
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Numero de telefono -->
            <div>
                <InputLabel for="telnum" value="Phone Number" />
                    <p class="mt-1 block w-full">{{ form.phone }}</p>
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="flex items-center gap-4">

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                </Transition>
            </div>
        </form>
    </section>
</template>
