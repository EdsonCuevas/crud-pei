<script setup>
import { CalendarIcon, UserIcon, UsersIcon, Text  } from 'lucide-vue-next'
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayoutProgram.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  program:{type:Object},
  creator:{type:Object},
  coordinator:{type:Object},
  users:{type:Object}
});
</script>

<template>
  <AuthenticatedLayout>
      <Head title="Programa" />
      <div class="min-h-screen bg-gradient-to-b to-white">
          <div class="container mx-auto">
              <div class="bg-blue-500 text-white p-6">
                  <h2 class="text-3xl font-semibold">{{ program.title }}</h2>
                  <p class="text-blue-100">Educational support program</p>
              </div>
              <div class="p-6 grid md:grid-cols-2 gap-6">
                  <div class="space-y-4">
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <Text class="h-4 w-4" />
                          <span><strong>Description:</strong> {{ program.description }}</span>
                      </div>
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <UserIcon class="h-4 w-4" />
                          <span><strong>Created by:</strong> {{ creator ? (creator.name ? creator.name : '') : '' }}</span>
                      </div>
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <UserIcon class="h-4 w-4" />
                          <span><strong>Coordinator:</strong> {{ coordinator ? (coordinator.name ? coordinator.name : '') : '' }}</span>
                      </div>
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <CalendarIcon class="h-4 w-4" />
                          <span><strong>Date of Creation:</strong> {{ new Date(program.created_at).toLocaleString() }}</span>
                      </div>
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <CalendarIcon class="h-4 w-4" />
                          <span><strong>Last Modification:</strong> {{ new Date(program.updated_at).toLocaleString() }}</span>
                      </div>
                      <div class="flex items-center space-x-2 text-sm text-gray-500">
                          <UsersIcon class="h-4 w-4" />
                          <span><strong>Beneficiaries:</strong></span>
                      </div>
                      <div class="flex flex-wrap gap-2">
                          <span v-for="program in users" :key="program.id" class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">
                              {{ program.name }}
                          </span>
                      </div>
                  </div>
                  <div class="win-w-0 p-4 rounded-lg shadow-xs">
                      <img :src="`/storage/img/${program.image}`" :alt="program.title">
                  </div>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>