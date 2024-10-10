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
            <li><a href="home" class="hover:underline">Home</a></li>
            <li><a href="programs" class="hover:underline">Programs</a></li>
            <li><a href="contact" class="hover:underline">Contact us</a></li>
          </ul>
        </nav>
        <a href="/donation">
          <button class="flex items-center space-x-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
            Donate
          </button>
        </a>
        
        <a href="/dashboard">
          <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            <UserIcon class="w-6 h-6"/> 
          </button>
        </a>
        
      </div>
    </div>
  </header>
</template>

<script setup>
import { UserIcon } from 'lucide-vue-next'
</script>
