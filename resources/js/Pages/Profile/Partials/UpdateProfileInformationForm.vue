<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
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
    email: user.email,
    phone: user.phone,
    rfc: user.rfc,
    birthdate: user.birthdate,
});

const srcImg = ref('../../storage/img/profile/profile-icon.png');

const imageForm = useForm({
    image: user.photo,
});

if (user.photo != null) {
    imageForm.image = user.photo;
    srcImg.value = '../../storage/img/profile/' + user.photo;
}

function showImg(event) {
    const file = event.target.files[0];
    if (file) {
        srcImg.value = URL.createObjectURL(file);
        imageForm.image = file; // Asigna el archivo seleccionado
    }
}
</script>

<template>
    <section>
        <!-- Formulario de imagen separado -->
        <header class="mt-10">
            <h2 class="text-lg font-medium text-gray-900">Update Profile Image</h2>
            <p class="mt-1 text-sm text-gray-600">Upload a new profile image for your account.</p>
        </header>

        <form @submit.prevent="imageForm.post(route('profile.updateImage'))" class="mt-6 space-y-6"
            enctype="multipart/form-data">

            <div class="mt-6">
                <h3 class="text-lg font-medium">Your Image:</h3>
                <img :src="srcImg" alt="Profile Image" class="mt-2 rounded-full w-32 h-32 object-cover"/>
                
            </div>

            <div>
                <InputLabel for="image" value="Updated image" />
                <input id="image" type="file" class="mt-1 block w-full" name="image" @change="showImg($event)" />
                <InputError class="mt-2" :message="imageForm.errors.image" />
            </div>



            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="imageForm.processing">Upload</PrimaryButton>
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="imageForm.recentlySuccessful" class="text-sm text-gray-600">Image successfully uploaded.
                    </p>
                </Transition>
            </div>
        </form>
        <br>
        <!-- Información personal -->
        <header>
            <h2 class="text-lg font-medium text-gray-900">Personal Information</h2>
            <p class="mt-1 text-sm text-gray-600">
                Update the profile information, email address and phone number of your account.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="E-mail" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="phone" value="Phone number" />
                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required
                    autocomplete="phone" />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div>
                <InputLabel for="rfc" value="RFC" />
                <TextInput id="rfc" type="text" class="mt-1 block w-full" v-model="form.rfc" />
                <InputError class="mt-2" :message="form.errors.rfc" />
            </div>

            <div>
                <InputLabel for="birthdate" value="Birthdate" />
                <TextInput id="birthdate" type="date" class="mt-1 block w-full" v-model="form.birthdate" required
                    autofocus autocomplete="birthdate" min="1900-01-01" :max="maxDate" />
                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Successfully saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>


<script>
export default {
    data() {
        return {
            form: {
                birthdate: '',
                errors: {
                    birthdate: '',
                },
            },
            maxDate: this.getCurrentDate(),
        };
    },
    methods: {
        getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Meses en JavaScript son 0-11
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`; // Formato YYYY-MM-DD
        },
    },
};
</script>