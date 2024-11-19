<script setup>
import { ref, onMounted } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import { usePage } from '@inertiajs/vue3';
import { Camera, Mail, Phone, Calendar, UserSquare } from 'lucide-vue-next';

const user = usePage().props.auth.user;
const isImageLoaded = ref(false);
const containerRef = ref(null);

// Ruta de la imagen
const srcImg = ref(user.photo ? `../../storage/img/profile/${user.photo}` : '../../storage/img/profile/profile-icon.png');
onMounted(() => {
  const img = new Image();
  img.onload = () => {
    isImageLoaded.value = true;
  };
  img.src = srcImg.value;

  if (containerRef.value) {
    const resizeObserver = new ResizeObserver(() => {
      // Aquí puedes agregar lógica adicional si necesitas
      // realizar acciones específicas cuando el tamaño cambie
    });
    resizeObserver.observe(containerRef.value);
  }
});
</script>

<template>
    <div class="flex-grow flex">
      <section 
        ref="containerRef"
        class="profile-container bg-white rounded-xl shadow-2xl overflow-hidden flex-grow flex"
      >
        <div class="flex flex-grow">
          <!-- Imagen y nombre del usuario -->
          <div class="profile-left bg-gradient-to-br from-blue-500 to-purple-800 p-6 w-1/4 flex flex-col justify-center items-center">
            <div class="relative mb-4">
              <div class="profile-img w-32 h-32 mx-auto rounded-full overflow-hidden shadow-lg transition-transform duration-500 ease-in-out transform hover:scale-105">
                <img 
                  :src="srcImg" 
                  alt="Imagen de perfil" 
                  class="w-full h-full object-cover transition-opacity duration-1000"
                  :class="{ 'opacity-100': isImageLoaded, 'opacity-0': !isImageLoaded }"
                />
              </div>
              <div class="absolute bottom-0 right-1/2 transform translate-x-1/2 translate-y-1/2 bg-white rounded-full p-2 shadow-lg">
                <Camera class="w-4 h-4 text-gray-600" />
              </div>
            </div>
            <div class="text-center">
              <h2 class="text-2xl font-bold text-white mb-2">{{ user.name }}</h2>
              <p class="text-blue-200 text-sm">Usuario</p>
            </div>
          </div>
  
          <!-- Información personal -->
          <div class="profile-right flex-grow p-6 w-3/4 overflow-y-auto">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Información Personal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100 p-2 rounded">
                <Mail class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0" />
                <div>
                  <p class="text-xs text-gray-600">E-mail</p>
                  <p class="text-sm text-gray-800">{{ user.email }}</p>
                </div>
              </div>
              <div class="flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100 p-2 rounded">
                <Phone class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" />
                <div>
                  <p class="text-xs text-gray-600">Teléfono</p>
                  <p class="text-sm text-gray-800">{{ user.phone }}</p>
                </div>
              </div>
              <div class="flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100 p-2 rounded">
                <Calendar class="w-5 h-5 text-red-500 mr-3 flex-shrink-0" />
                <div>
                  <p class="text-xs text-gray-600">Fecha de Nacimiento</p>
                  <p class="text-sm text-gray-800">{{ user.birthdate }}</p>
                </div>
              </div>
              <div class="flex items-center transition-all duration-300 ease-in-out hover:bg-gray-100 p-2 rounded">
                <UserSquare class="w-5 h-5 text-purple-500 mr-3 flex-shrink-0" />
                <div>
                  <p class="text-xs text-gray-600">RFC</p>
                  <p class="text-sm text-gray-800">{{ user.rfc }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>
  

  <style scoped>
  .profile-container {
    transition: all 0.3s ease-in-out;
    resize: both;
    overflow: auto;
    min-width: 1150px;
    min-height: 400px;
  }
  
  .profile-container:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.749);
  }
  
  .profile-img img {
    transition: transform 0.3s ease-in-out;
  }
  
  .profile-img:hover img {
    transform: scale(1.1);
  }
  
  @keyframes fadeIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
  }
  
  .profile-right > * {
    animation: fadeIn 0.5s ease-out forwards;
  }
  
  .profile-right > *:nth-child(1) { animation-delay: 0.1s; }
  .profile-right > *:nth-child(2) { animation-delay: 0.2s; }
  </style>