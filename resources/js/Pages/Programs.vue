<script setup>
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';
import Modal from '@/Components/Modal.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
  programas: { type: Object }
});

// Estado reactivo
const showModal = ref(false);
const selectedProgram = ref(null);
const searchTerm = ref(''); // Estado para el término de búsqueda
const isSearchActive = ref(false); // Nuevo estado para mostrar u ocultar el input de búsqueda

// Métodos
function openModal(program) {
  selectedProgram.value = program;
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
}

function toggleSearch() {
  isSearchActive.value = !isSearchActive.value;
}

// Computed para filtrar programas según el término de búsqueda
const filteredPrograms = computed(() => {
  return props.programas.filter(program =>
    program.title.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
    program.description.toLowerCase().includes(searchTerm.value.toLowerCase())
  );
});
const noResultsFound = computed(() => {
    return filteredPrograms.value.length === 0 && searchTerm.value !== '';
});

const registerUserToProgram = (programId) => {
  Swal.fire({
    title: "¿Estás seguro de que deseas inscribirte?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, inscribirme"
  }).then((result) => {
    if (result.isConfirmed) {
      // Llamar a la ruta de inscripción en el controlador HomeController
      router.post(route('inscripcion'), { program_id: programId }, {
        onSuccess: () => {
          Swal.fire({
            title: 'Inscrito!',
            text: '¡Tu inscripción ha sido exitosa!',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
          });
        },
        onError: (errors) => {
          let errorMessage = '';
          // Mostrar mensaje específico si el error es por estar ya inscrito
          if (errors.error_auth) {
            errorMessage = 'Necesitas iniciar sesion como beneficiario.';
          }
          else if (errors.already_registered) {
            errorMessage = 'Ya estás inscrito en este programa.';
          }
          Swal.fire({
            title: 'Error!',
            text: errorMessage,
            icon: 'error',
            timer: 2000,
            showConfirmButton: false
          });
        }
      });
    }
  });
};


</script>
<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <Header />

    <!-- Sección de Programas -->
    <div class="container mx-auto px-6 py-10">
      <h2 class="text-4xl font-bold mb-6 text-center text-gray-800">Our Programs</h2>

      <!-- Campo de búsqueda con lupa -->
      <div class="mb-12 text-center relative flex justify-center items-center">
      <!-- Icono de lupa -->
        <!-- Icono de lupa -->
        <button v-if="!isSearchActive" @click="toggleSearch" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a7 7 0 017 7 7 7 0 11-7-7z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
          </svg>
        </button>
        



        <!-- Campo de búsqueda que aparece con animación -->
        <transition name="fade" mode="out-in">
          <input
            v-if="isSearchActive"
            v-model="searchTerm"
            type="text"
            placeholder="Search for a program..."
            class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-500"
          />
        </transition>
      </div>
      <div v-if="noResultsFound" class="text-4x1 text-center mb-center text-red-500 ">
      No results found for "{{ searchTerm }}".
    </div>
      
      

      <!-- Grid de Programas -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="program in filteredPrograms"
          :key="program.id"
          @click="openModal(program)"
          class="bg-white shadow-lg rounded-lg p-6 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 cursor-pointer"
        >
          <img :src="'storage/img/' + program.image" :alt="'Imagen de ' + program.title" class="w-full h-40 object-cover mb-4 rounded-md">
          <h3 class="text-2xl font-bold mb-4">{{ program.title }}</h3>
          <p class="text-gray-600 line-clamp-3">{{ program.description }}</p><br>   
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

        <h2 class="font-extrabold text-2xl text-gray-800 mt-4 mb-2 text-left break-words">{{ selectedProgram.title }}</h2>
        <img :src="'storage/img/' + selectedProgram.image" :alt="selectedProgram.title + ' Image'"
          class="w-full max-w-md h-auto object-cover rounded-lg mb-4 mx-auto shadow-md transition-all duration-200 transform hover:scale-105">
        <p class="text-gray-600 text-base leading-relaxed mb-6 text-justify break-words">{{ selectedProgram.description }}</p>

        <div class="flex justify-end">
            <button @click="registerUserToProgram(selectedProgram.id)"
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

.transition-all {
  transition: all 0.3s ease;
}

.hover\\:scale-105:hover {
  transform: scale(1.05);
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line: 3;
  overflow: hidden;
}

button {
  transition: transform 0.2s ease;
}

button:hover {
  transform: scale(1.1);
}

/* Transición para el input de búsqueda */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
