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

        <!-- Section 2: Áreas de Actuación -->
        <section class="py-16 bg-gray-100">
          <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Our Areas of Activity</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
              <!-- Tarjeta 1 -->
              <div
                v-motion
                :initial="{ opacity: 0, y: 30 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: 0 } }"
                :hover="{ scale: 1.05 }"
                class="bg-white shadow-md rounded-lg p-4"
              >
                <img src="https://th.bing.com/th/id/OIP.0LEiZH0IjiXl_xQ6bbx7aQHaD9?rs=1&pid=ImgDetMain" alt="Ciencia y Tecnología" class="w-full h-40 object-cover mb-4 rounded-md">
                <h3 class="text-xl font-bold mb-2">Science and Technology</h3>
                <p>We support scientific research and technological development to address global challenges.</p>
              </div>
              <!-- Tarjeta 2 -->
              <div
                v-motion
                :initial="{ opacity: 0, y: 30 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: 0.1 } }"
                :hover="{ scale: 1.05 }"
                class="bg-white shadow-md rounded-lg p-4"
              >
                <img src="https://live.staticflickr.com/5082/5373580138_61a2ec8c0e_b.jpg" alt="Cultura" class="w-full h-40 object-cover mb-4 rounded-md">
                <h3 class="text-xl font-bold mb-2">Culture</h3>
                <p>We promote artistic creation and the dissemination of cultural knowledge in all its forms.</p>
              </div>
              <!-- Tarjeta 3 -->
              <div
                v-motion
                :initial="{ opacity: 0, y: 30 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: 0.2 } }"
                :hover="{ scale: 1.05 }"
                class="bg-white shadow-md rounded-lg p-4"
              >
                <img src="https://economipedia.com/wp-content/uploads/Fundacion.jpg" alt="Educación" class="w-full h-40 object-cover mb-4 rounded-md">
                <h3 class="text-xl font-bold mb-2">Education</h3>
                <p>We promote innovative educational programs to train the leaders of the future.</p>
              </div>
            </div>
          </div>
        </section>

        <!-- Section 3: Noticias -->
        <section class="py-16">
          <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Latest Programs</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <div
                v-for="(i, index) in 3"
                :key="i"
                v-motion
                :initial="{ opacity: 0, y: 30 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: index * 0.1 } }"
                :hover="{ scale: 1.05 }"
                class="bg-white shadow-md rounded-lg p-4"
              >
                <img :src="'https://th.bing.com/th/id/OIP.8vuk9oG3oMnhc3JmyjMWVQHaDd?rs=1&pid=ImgDetMain text=News+' + i" :alt="'Programa ' + i" class="w-full h-40 object-cover mb-4 rounded-md">
                <h3 class="text-xl font-bold mb-2">{{ 'Program title ' + i }}</h3>
                <p>Description.</p>
              </div>
            </div>
          </div>
        </section>
  
        <!-- Section 4: Misión -->
        <section class="py-16 bg-blue-900 text-white">
          <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Our Mission</h2>
            <p class="text-xl max-w-3xl mx-auto">
              At the CTI Foundation, we are dedicated to advancing knowledge, research and innovation to build a better future for all. 
               We work in collaboration with leading institutions and experts around the world to make a positive impact on society.
            </p>
            <button class="mt-8 border-white border text-white p-2 rounded hover:bg-white hover:text-blue-800">
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
    components:{
    Header,
    Footer,
    },
  };
  </script>
  