<template>
  <header class="bg-white text-blue-900 shadow-md h-20 ">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center h-full">
    <div class="flex items-center space-x-3">
      <div class="text-2xl font-bold">
      <!-- Imagen con tamaño adaptado al header -->
      <img src="/images/LOGOCTI.png" alt="Logo Fundación CTI" class="max-h-13 w-auto">

    </div>
    </div>


      <div class="flex items-center space-x-6">
        <nav class="hidden md:block">
          <ul class="flex space-x-6">
            <li><a href="#" class="hover:underline">Inicio</a></li>
            <li><a href="#" class="hover:underline">Programas</a></li>
            <li><a href="#" class="hover:underline">Sobre Nosotros</a></li>
            <li><a href="#" class="hover:underline">Contacto</a></li>
          </ul>
        </nav>
        <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
          <UserIcon class="w-7 h-7"/> 
        </button>
        <button class="flex  items-center space-x-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white p-2 rounded">
          Quiero donar
        </button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { UserIcon } from 'lucide-vue-next'
</script>
