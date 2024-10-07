<template>
    <Header/>
    <div class="min-h-screen bg-[#0000000] flex items-center justify-center p-6">
      <div class="w-full max-w-md bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-8">
          <h1 class="text-4xl font-bold text-[#072146] mb-2">Contactanos</h1>
          <p class="text-[#97999B] mb-6">Por favor, rellene este formulario de manera decente</p>
          
          <form @submit.prevent="submitForm" class="space-y-6">
            <div>
              <h3 class="text-lg font-semibold text-[#072146] mb-2">Nombre Completo</h3>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <input v-model="firstName" type="text" placeholder="Nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1973B8]">
                  
                </div>
                <div>
                  <input v-model="lastName" type="text" placeholder="Apellido" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1973B8]">
                  
                </div>
              </div>
            </div>
            
            <div>
              <h3 class="text-lg font-semibold text-[#072146] mb-2">Email</h3>
              <input v-model="email" type="email" placeholder="correo@correo.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1973B8]">
              
            </div>
            
            <div>
              <h3 class="text-lg font-semibold text-[#072146] mb-2">Mensaje</h3>
              <textarea v-model="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#1973B8]"></textarea>
            </div>
            
            <button type="submit" class="w-full bg-[#1973B8] text-white py-2 px-4 rounded-md hover:bg-[#1464A5] transition duration-300 ease-in-out">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
    <Footer/>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import Footer from '@/Components/Footer.vue';
  import Header from '@/Components/Header.vue';
  //logica para envio de formulario por si las moscas
  const firstName = ref('')
  const lastName = ref('')
  const email = ref('')
  const message = ref('')
  
  const submitForm = () => {
    console.log('Form submitted', { firstName: firstName.value, lastName: lastName.value, email: email.value, message: message.value })
  }
  </script>