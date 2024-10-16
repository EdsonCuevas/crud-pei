<script setup>
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const props = defineProps({
  programas: { type: Object }
});

// Estado reactivo
const showModal = ref(false);
const selectedProgram = ref(null);

// Métodos
function openModal(program) {
  selectedProgram.value = program;
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
}

</script>

<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <Header />

    <!-- Sección de Programas -->
    <div class="container mx-auto px-6 py-10">
    <h2 class="text-4xl font-bold mb-12 text-center text-gray-800">Our Programs</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div
          v-for="program in props.programas"
          :key="program.id"
          @click="openModal(program)"
          class="bg-white shadow-lg rounded-lg p-6 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 cursor-pointer"
        >
          <img :src="'storage/img/' + program.image" :alt="'Imagen de ' + program.title" class="w-full h-40 object-cover mb-4 rounded-md">
          <h3 class="text-2xl font-bold mb-4">{{ program.title }}</h3>
          <p class="text-gray-600 line-clamp-3">{{ program.description }}</p><br>   
        <!-- Botón azul de "Más información" -->
        <div class="text-center">
            <button @click="openModal(program)"
                class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                Más información
            </button>
        </div>
        </div>
      </div>
    </div>

    <!-- Modal para la información detallada del programa -->
    <Modal :show="showModal" @close="closeModal">
      <div class="p-6 relative bg-white rounded-lg shadow-lg transition-all duration-300 transform scale-100">
        <button @click="closeModal"
          class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full transition-all">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <!-- Detalles del programa -->
        <h2 class="font-extrabold text-2xl text-gray-800 mt-4 mb-2 text-left break-words">{{ selectedProgram.title }}</h2>
        <img :src="'storage/img/' + selectedProgram.image" :alt="selectedProgram.title + ' Image'"
          class="w-full max-w-md h-auto object-cover rounded-lg mb-4 mx-auto shadow-md transition-all duration-200 transform hover:scale-105">
        <p class="text-gray-600 text-base leading-relaxed mb-6 text-justify break-words">{{ selectedProgram.description }}</p>

        <!-- Botón de "Inscribirse" -->
        <div class="flex justify-end">
            <button @click="subscribeToProgram(selectedProgram)"
                class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                Inscribirse
            </button>
        </div>
      </div>
    </Modal>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<style scoped>
/* Estilos generales */
h3 {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 1rem;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

h2 {
  font-size: 1.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
  word-break: break-word;
}

p {
  font-size: 1rem;
  line-height: 1.75rem;
  text-align: justify;
}

/* Transición suave de los elementos */
.transition-all {
  transition: all 0.3s ease;
}

/* Animación de hover en las tarjetas */
.hover\\:scale-105:hover {
  transform: scale(1.05);
}

/* Estilo para limitar el número de líneas del texto */
.line-clamp-3 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
  overflow: hidden;
}

/* Estilo para el modal */
button {
  transition: transform 0.2s ease;
}
button:hover {
  transform: scale(1.1);
}
</style>
