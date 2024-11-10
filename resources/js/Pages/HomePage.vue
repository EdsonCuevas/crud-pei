<script setup>
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';
import Modal from '@/Components/Modal.vue';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';



const props = defineProps({
  programas: { type: Object }
});

// Estado reactivo
const showModal = ref(false); // Controla la visibilidad del modal
const selectedProgram = ref(null); // Guarda los detalles del programa seleccionado
const isHovered = ref(false); // Nuevo estado para controlar el hover

// Duplicar los programas para el efecto infinito
const duplicatedPrograms = computed(() => {
  const programs = props.programas.slice(0, 6);
  return [...programs, ...programs];
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

// Métodos
function openModal(program) {
  selectedProgram.value = program; // Almacena el programa seleccionado
  showModal.value = true; // Muestra el modal
}

function closeModal() {
  showModal.value = false; // Oculta el modal
}

// Efecto de desvanecimiento en la sección de Misión
function handleScroll() {
  const missionSection = document.querySelector('.fade-on-scroll');
  if (missionSection) {
    const rect = missionSection.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    if (rect.top <= windowHeight) {
      missionSection.style.opacity = 1 - (rect.top / windowHeight);
    }
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
});

</script>

<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <Header />

    <main class="flex-grow">
      <!-- Section 1: Intro -->
      <section class="bg-blue-800 text-white py-20">
        <div class="container mx-auto px-4">
          <!-- Usamos <transition> para animar el h1 -->
          <transition name="bounce" appear>
            <h1 class="text-5xl font-bold mb-6">Boosting knowledge and innovation</h1>
          </transition>
          <transition name="bounce" appear>
            <h2 class="text-xl mb-8">
              Discover how we are transforming lives through science, culture and education.
            </h2>
          </transition>


          <transition name="bounce" appear>
            <button class="text-white border-white hover:bg-white hover:text-blue-800 border p-2 rounded"
              onclick="window.location.href='programs';">
              Browse programs
            </button>
          </transition>
        </div>
      </section>


      <!-- Section 3: Latest Programs Carousel -->
      <section class="py-20 bg-white">
        <div class="container mx-auto px-6 relative">
          <transition name="slide-up" appear>
            <h2 class="text-4xl bg-white font-bold mb-12 text-center text-gray-800" style="letter-spacing: 0.1em;">
              Latest Programs
            </h2>
          </transition>
          <!-- Relieve en los lados del carrusel -->
          <div class="relative overflow-hidden">
            <!-- Relieve/fade en los bordes -->
            <div
              class="fade-effect-left absolute left-0 top-0 h-full w-20 bg-gradient-to-r from-gray-50 to-transparent pointer-events-none">
            </div>
            <div
              class="fade-effect-right absolute right-0 top-0 h-full w-20 bg-gradient-to-l from-gray-50 to-transparent pointer-events-none">
            </div>

            <!-- Carrusel con animación infinita -->
            <div class="carousel bg-white pt-12 py-6 flex items-center" @mouseover="isHovered = true"
              @mouseleave="isHovered = false">
              <!-- Animación del scroll -->
              <div class="animate-scroll p-5 flex items-center"
                :style="{ animationPlayState: (showModal || isHovered) ? 'paused' : 'running' }">
                <!-- Duplicamos los programas para la ilusión de infinito -->
                <div v-for="(program, index) in duplicatedPrograms" :key="index"
                  class="bg-white shadow-lg rounded-[30px] p-8 max-w-[450px] w-[500px] h-[500px] overflow-hidden transition-transform duration-300 hover:scale-105 hover:bg-gray-200 cursor-pointer mr-10">
                  <!-- Contenido de la tarjeta del programa -->
                  <a href="javascript:void(0)" @click="openModal(program)">
                    <img :src="'storage/img/' + program.image" :alt="'Program Image: ' + program.title"
                      class="w-full h-56 object-cover mb-6 rounded-lg">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-700">{{ program.title }}</h3>
                    <p class="text-gray-600 line-clamp-3 mb-4">{{ program.description }}</p>
                  </a>
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
          </div>
        </div>
      </section>

      <!-- Section 2: Áreas de Actuación -->
      <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
          <h2 class="text-4xl font-bold mb-12 text-center">Our Areas of Activity</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <!-- Tarjeta 1 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0 }" :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://th.bing.com/th/id/OIP.0LEiZH0IjiXl_xQ6bbx7aQHaD9?rs=1&pid=ImgDetMain"
                alt="Ciencia y Tecnología" class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Science and Technology</h3>
              <p>We support scientific research and technological development to address global challenges.</p>
            </div>
            <!-- Tarjeta 2 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0 }" :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://live.staticflickr.com/5082/5373580138_61a2ec8c0e_b.jpg" alt="Cultura"
                class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Culture</h3>
              <p>We promote artistic creation and the dissemination of cultural knowledge in all its forms.</p>
            </div>
            <!-- Tarjeta 3 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0 }" :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://economipedia.com/wp-content/uploads/Fundacion.jpg" alt="Educación"
                class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Education</h3>
              <p>We promote innovative educational programs to train the leaders of the future.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal para la información detallada del programa -->
      <Modal :show="showModal" @close="closeModal">
        <div class="p-6 relative bg-white rounded-lg shadow-lg transition-all duration-300 transform scale-100">
          <!-- Botón para cerrar modal -->
          <button @click="closeModal"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Detalles del programa -->
          <h2 class="font-extrabold text-2xl text-gray-800 mt-4 mb-2 text-left break-words">
            {{ selectedProgram.title }}
          </h2>
          <img :src="'storage/img/' + selectedProgram.image" :alt="selectedProgram.title + ' Image'"
            class="w-full max-w-md h-auto object-cover rounded-lg mb-4 mx-auto shadow-md transition-all duration-200 transform hover:scale-105">
          <br>
          <p class="text-gray-600 text-base leading-relaxed mb-6 text-justify break-words">
            {{ selectedProgram.description }}
          </p>

          <!-- Botón de "Inscribirse" -->
          <div class="flex justify-end">
            <button @click="registerUserToProgram(selectedProgram.id)"
              class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
              Inscribirse
            </button>
          </div>
        </div>
      </Modal>

      <!-- Section 4: Misión -->
      <section class="py-20 bg-blue-900 text-white fade-on-scroll">
        <div class="container mx-auto px-6 text-center">
          <h2 class="text-4xl font-bold mb-10">Our Mission</h2>
          <p class="text-2xl max-w-4xl mx-auto mb-10">
            At the CTI Foundation, we are dedicated to advancing knowledge, research and innovation to build a better
            future for all.
            We work in collaboration with leading institutions and experts around the world to make a positive impact on
            society.
          </p>
          <button class="mt-10 border-white border text-white px-6 py-3 rounded hover:bg-white hover:text-blue-800"
            onclick="window.location.href='about';">
            Learn more About us
          </button>

        </div>
      </section>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>



<style scoped>
.carousel {
  overflow: hidden;
}

.animate-scroll {
  display: flex;
  animation: scroll 30s linear infinite;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }

  100% {
    transform: translateX(-50%);
  }
}

/* Ajustar los espacios entre tarjetas */
.animate-scroll>div {
  margin-right: 2.5rem;
  /* Equivalente a Tailwind's space-x-10 */
}

/* Efecto de desvanecimiento en los bordes del carrusel */
.fade-effect-left,
.fade-effect-right {
  pointer-events: none;
}

.carousel::before,
.carousel::after {
  content: '';
  position: absolute;
  top: 0;
  width: 15%;
  /* Ajusta según la intensidad del sombreado */
  height: 100%;
  z-index: 2;
  /* Asegúrate de que esté por encima del carrusel */
  pointer-events: none;
  /* Para que no interfiera con los clics */
}

.carousel::before {
  left: 0;
  background: linear-gradient(to right, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%);
}

.carousel::after {
  right: 0;
  background: linear-gradient(to left, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%);
}

/* Estilos para los títulos y textos */
h3 {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 1rem;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

h2 {
  font-size: 1.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
  word-break: break-word;
  overflow-wrap: break-word;
}

p {
  font-size: 1rem;
  line-height: 1.75rem;
  text-align: justify;
  overflow-wrap: break-word;
}

/* Efecto de desvanecimiento en la sección de Misión */
.fade-on-scroll {
  transition: opacity 0.5s ease-out;
  opacity: 1;
}

.bounce-enter-active {
  animation: bounceIn 1s ease;
}

.bounce-leave-active {
  animation: bounceOut 1s ease;
}

@keyframes bounceIn {
  0% {
    transform: translateX(-100%);
    opacity: 0;
  }

  50% {
    transform: translateX(20%);
    opacity: 0.5;
  }

  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes bounceOut {
  0% {
    transform: translateX(0);
    opacity: 1;
  }

  100% {
    transform: translateX(100%);
    opacity: 0;
  }
}

.slide-up-enter-active {
  animation: slideUp .5s ease-out;
}

.slide-up-leave-active {
  animation: slideDown 1ms ease-out;
}

/* Definimos la animación de aparecer desde abajo */
@keyframes slideUp {
  0% {
    transform: translateY(100%);
    opacity: 0;
  }

  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Opción de animación al salir, si es necesario */
@keyframes slideDown {
  0% {
    transform: translateY(0);
    opacity: 1;
  }

  100% {
    transform: translateY(100%);
    opacity: 0;
  }
}
</style>
