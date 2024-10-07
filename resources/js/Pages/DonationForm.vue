<template>
    <Header/>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <div class="w-full max-w-2xl   bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6">
          <h1 class="text-2xl font-bold text-[#004481] mb-5 text-center">
            Estás a un paso de apoyar el sueño de miles de estudiantes
          </h1>
          
          <div class="flex space-x-2 mb-6">
            <button
              @click="donationType = 'single'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'single' ? 'bg-[#004481] text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
              Donación única
            </button>
            <button
              @click="donationType = 'monthly'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'monthly' ? 'bg-[#004481] text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
              Donación mensual
            </button>
          </div>
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Selecciona el monto de tu aportación</h3>
            <div class="grid grid-cols-3 gap-2 mb-2">
              <button
                v-for="amount in ['$350', '$500', '$750']"
                :key="amount"
                class="py-2 px-4 border border-[#004481] text-[#004481] rounded-md hover:bg-[#004481] hover:text-white transition-colors duration-200"
              >
                {{ amount }}
              </button>
            </div>
            <input
              type="text"
              placeholder="Otra cantidad"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
            />
          </div>
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Completa tus datos personales</h3>
            <div class="space-y-2">
              <input
                type="text"
                placeholder="Nombre(s)"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="text"
                placeholder="Apellido Paterno"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="text"
                placeholder="Apellido Materno"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="email"
                placeholder="Correo electrónico"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="tel"
                placeholder="Teléfono"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
            </div>
          </div>
          
          <div class="text-xs text-center text-gray-500 mb-4">
            Donativo seguro.<br />
            Tus datos quedarán cifrados
          </div>
          
          <button class="w-full py-3 bg-[#1973B8] text-white rounded-md hover:bg-[#004481] transition-colors duration-200">
            Continuar
          </button>
        </div>
      </div>
    </div>
    <Footer />
  </template>
  
  <script setup>
   import Footer from '@/Components/Footer.vue';
   import Header from '@/Components/Header.vue';
  import { ref } from 'vue'
  
  const donationType = ref('single')
  </script>