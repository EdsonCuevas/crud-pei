<script setup>
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

// Ruta de la imagen
const srcImg = ref(user.photo ? `../../storage/img/profile/${user.photo}` : '../../storage/img/profile/profile-icon.png');

</script>

<template>
    <section class="profile-container p-6 bg-white rounded-lg flex flex-col md:flex-row w-full items-center">
        <!-- Imagen y nombre del usuario -->
        <div class="profile-left flex flex-col items-center md:w-1/3 justify-center md:justify-start">
            <div class="profile-img w-48 h-48 mb-4">
                <img :src="srcImg" alt="Imagen de perfil" class="w-full h-full object-cover rounded-lg" />
            </div>
            <div class="text-center mt-4">
                <h2 class="text-2xl font-semibold text-gray-800">{{ user.name }}</h2>
                <p class="text-sm text-gray-600">Usuario</p>
            </div>
        </div>

        <!-- Información personal -->
        <div class="profile-right flex-grow p-4 mt-6 md:mt-0 md:ml-6 w-full md:w-2/3">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Personal information</h3>
            <div class="mb-4">
                <InputLabel value="E-mail:" />
                <p class="mt-1 text-lg text-gray-700">{{ user.email }}</p>
            </div>
            <div class="mb-4">
                <InputLabel value="Teléfono:" />
                <p class="mt-1 text-lg text-gray-700">{{ user.phone }}</p>
            </div>
            <div class="mb-4">
                <InputLabel value="Fecha de Nacimiento:" />
                <p class="mt-1 text-lg text-gray-700">{{ user.birthdate }}</p>
            </div>
            <div class="mb-4">
                <InputLabel value="RFC:" />
                <p class="mt-1 text-lg text-gray-700">{{ user.rfc }}</p>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Contenedor general */
.profile-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%; /* Asegura que ocupe todo el ancho */
    max-width: 100vw;
}

/* Sección izquierda (imagen y nombre) */
.profile-left {
    display: flex;
    flex-direction: column; /* Para que el nombre esté debajo de la imagen */
    align-items: center;
    justify-content: center;
    width: 100%;
}

/* Imagen de perfil */
.profile-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px; /* Esquinas ligeramente redondeadas */
}

/* Sección derecha (información personal) */
.profile-right {
    width: 100%;
    max-width: 600px;
    display: flex;
    flex-direction: column;
}

/* Ajustes responsivos */
@media (min-width: 768px) {
    .profile-container {
        flex-direction: row;
        justify-content: space-between;
    }

    .profile-left {
        width: 30%; /* Espacio de la imagen y nombre */
    }

    .profile-right {
        width: 70%; /* Espacio para la información */
    }
}
</style>
