<template>
  <header class="bg-white text-blue-900 shadow-md h-20 ">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center h-full">
    <div class="flex items-center space-x-3">
      <div class="text-2xl font-bold">
      <!-- Imagen con tamaño adaptado al header -->
      <img 
        src="/images/LOGOCTI.png" 
        alt="Logo Fundación CTI" 
        class="max-h-13 w-auto" 
        style="cursor: pointer;" 
        onclick="window.location.href='/home';">
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
        
        <button class="flex  items-center space-x-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white p-2 rounded">
          Quiero Apoyar
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-handshake"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/><path d="m18 15-2-2"/><path d="m15 18-2-2"/></svg>
        </button>

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
