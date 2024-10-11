<script setup>
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';

const props = defineProps({
  programas: { type: Object }
});

</script>


<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <Header />

    <!-- Main Content -->
    <main class="flex-grow">
      <!-- Section 1: Intro -->
      <section class="bg-blue-800 text-white py-20">
        <div class="container mx-auto px-4">
          <h1 class="text-5xl font-bold mb-6">Boosting knowledge and innovation</h1>
          <p class="text-xl mb-8">Discover how we are transforming lives through science, culture and education.</p>
          <button class="text-white border-white hover:bg-white hover:text-blue-800 border p-2 rounded">
            Browse programs
          </button>
        </div>
      </section>

      <!-- Section 2: Areas de Actuación -->
      <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
          <h2 class="text-4xl font-bold mb-12 text-center">Our Areas of Activity</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <!-- Tarjeta 1 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0, transition: { delay: 0 } }"
              :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://th.bing.com/th/id/OIP.0LEiZH0IjiXl_xQ6bbx7aQHaD9?rs=1&pid=ImgDetMain"
                alt="Ciencia y Tecnología" class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Science and Technology</h3>
              <p>We support scientific research and technological development to address global challenges.</p>
            </div>
            <!-- Tarjeta 2 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0, transition: { delay: 0.1 } }"
              :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://live.staticflickr.com/5082/5373580138_61a2ec8c0e_b.jpg" alt="Cultura"
                class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Culture</h3>
              <p>We promote artistic creation and the dissemination of cultural knowledge in all its forms.</p>
            </div>
            <!-- Tarjeta 3 -->
            <div v-motion :initial="{ opacity: 0, y: 30 }" :enter="{ opacity: 1, y: 0, transition: { delay: 0.2 } }"
              :hover="{ scale: 1.05 }"
              class="bg-white shadow-lg rounded-lg p-10 transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
              <img src="https://economipedia.com/wp-content/uploads/Fundacion.jpg" alt="Educación"
                class="w-full h-64 object-cover mb-8 rounded-md">
              <h3 class="text-3xl font-bold mb-6">Education</h3>
              <p>We promote innovative educational programs to train the leaders of the future.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Section 3: Latest Programs Carousel -->
      <section class="py-20">
        <div class="container mx-auto px-6">
          <h2 class="text-4xl font-bold mb-12 text-center">Latest Programs</h2>
          <div class="relative overflow-hidden">
            <div class="carousel flex items-center space-x-10 animate-scroll">
              <div v-for="(i, index) in props.programas" :key="i" v-motion :initial="{ opacity: 0, y: 30 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: (index % 3) * 0.1 } }" :hover="{ scale: 1.1 }"
                @mouseover="pauseCarousel" @mouseleave="resumeCarousel"
                class="bg-white shadow-lg rounded-lg p-10 min-w-[500px] transition-transform duration-300 hover:scale-110 hover:bg-gray-300">
                <img :src="'storage/img/' + i.image" :alt="'Programa ' + i.title"
                  class="w-full h-64 object-cover mb-8 rounded-md">
                <h3 class="text-3xl font-bold mb-6">{{ i.title }}</h3>
                <p>{{ i.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

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
          <button class="mt-10 border-white border text-white px-6 py-3 rounded hover:bg-white hover:text-blue-800">
            Learn more about us
          </button>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script>
import Footer from '@/Components/Footer.vue';
import Header from '@/Components/Header.vue';

export default {
  components: {
    Header,
    Footer,
  },
  methods: {
    pauseCarousel() {
      document.querySelector('.animate-scroll').style.animationPlayState = 'paused';
    },
    resumeCarousel() {
      document.querySelector('.animate-scroll').style.animationPlayState = 'running';
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      const missionSection = document.querySelector('.fade-on-scroll');
      const rect = missionSection.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      if (rect.top <= windowHeight) {
        missionSection.style.opacity = 1 - (rect.top / windowHeight);
      }
    },
    pauseCarousel() {
      document.querySelector('.animate-scroll').style.animationPlayState = 'paused';
    },
    resumeCarousel() {
      document.querySelector('.animate-scroll').style.animationPlayState = 'running';
    }
  }
};
</script>

<style scoped>
@keyframes scroll {
  0% {
    transform: translateX(0);
  }

  100% {
    transform: translateX(calc(-500px * 6 - 50px * 6));
  }
}

.animate-scroll {
  display: flex;
  width: max-content;
  animation: scroll 30s linear infinite;
  animation-play-state: running;
}

.fade-on-scroll {
  transition: opacity 0.5s ease-out;
  opacity: 1;
}
</style>
