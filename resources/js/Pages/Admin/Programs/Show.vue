<template>
    <AuthenticatedLayout>

    <div class="min-h-screen bg-gradient-to-b to-white">
      <div class="container mx-auto">
          <div class="bg-blue-500 text-white p-6">
            <h2 class="text-3xl font-semibold">Becas Benito Juarez</h2>
            <p class="text-blue-100">Programa de apoyo educativo</p>
          </div>
          <div class="p-6 grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
            <NotebookText class="h-4 w-4" />
            <span><strong>Descripción:</strong> {{ program.description }}</span>
            </div>
              <div class="flex items-center space-x-2 text-sm text-gray-500">
                <UserIcon class="h-4 w-4" />
                <span><strong>Creado por:</strong> {{ creator.name }}</span>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
            <UserIcon class="h-4 w-4" />
            <span><strong>Coordinado por:</strong> {{ coordinator.name }}</span>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-500">
      <CalendarIcon class="h-4 w-4" />
      <span><strong>Fecha de Creación:</strong> {{ new Date(program.created_at).toLocaleString() }}</span>
    </div>
    <div class="flex items-center space-x-2 text-sm text-gray-500">
      <CalendarIcon class="h-4 w-4" />
      <span><strong>Última Modificación:</strong> {{ new Date(program.updated_at).toLocaleString() }}</span>
    </div>
                
        <div class="flex items-center space-x-2 text-sm text-gray-500">
                <UsersIcon class="h-4 w-4" />
                <span><strong>Beneficiarios:</strong></span>
              </div>
              <p>
          <div class="flex flex-wrap gap-2">
            <span v-for="(b, i) in users" :key="b.id" class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">
              <a v-if="i === (users.length - 1)">{{ b.name }}</a>
              <a v-else>{{ b.name + ' ' }}</a>
            </span>
          </div>
        </p>
            </div>
            <div class="win-w-0 p-4 rounded-lg shadow-xs">
        <img :src="`/storage/img/${program.image}`" :alt="program.title" width="500">
      </div>
          </div>
        </div>
      </div>
</AuthenticatedLayout>

  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { CalendarIcon, UserIcon, UsersIcon, NotebookText } from 'lucide-vue-next'
  import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayoutProgram.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';

 
  const props = defineProps({
    program:{type:Object},
    creator:{type:Object},
    coordinator:{type:Object},
    users:{type:Object}
});
  </script>