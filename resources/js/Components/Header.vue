<script setup>
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { ref, computed } from 'vue'
import { usePage, router  } from '@inertiajs/vue3'

// Obtener los props enviados desde Laravel con Inertia
const { props } = usePage()

// Determinar si el usuario está autenticado
const authUser = computed(() => props.auth.user)

// Estado para controlar la visibilidad del menú móvil
const showingMobileMenu = ref(false)

// Función para alternar el menú móvil
const toggleMobileMenu = () => {
  showingMobileMenu.value = !showingMobileMenu.value
}

const handleLogout = () => {
  router.post(route('logout'), {}, {
    onSuccess: () => {
      window.location.href = '/';
    },
  });
}
</script>

<template>
  <header class="bg-white text-blue-900 shadow-md h-20 border-b-2 border-blue-400">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center h-full">
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <div class="text-2xl font-bold">
          <img 
            src="/images/LOGOCTI.png" 
            alt="Logo Fundación CTI" 
            class="max-h-13 w-auto cursor-pointer" 
            @click="$inertia.visit('/home')">
        </div>
      </div>

      <!-- Navegación y acciones -->
      <div class="flex items-center space-x-6">
        <!-- Botón de hamburguesa solo si el usuario está autenticado -->
        <button 
          v-if="authUser"
          @click="toggleMobileMenu"
          class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
          aria-label="Menu"
        >
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Navegación principal -->
        <nav class="hidden md:block">
          <ul class="flex space-x-6">
            <li><a href="/home" class="hover:underline">Home</a></li>
            <li><a href="/programs" class="hover:underline">Programs</a></li>
            <li><a href="/contact" class="hover:underline">Contact us</a></li>
          </ul>
        </nav>

        <!-- Dropdown para usuario autenticado -->
        <Dropdown v-if="authUser">
          <template #trigger>
            <img 
            :src="'../../storage/img/profile/'+authUser.photo || '/images/default-profile.png'" 
            alt="Profile" 
            class="w-10 h-10 rounded-full object-cover cursor-pointer">
          </template>

          <template #content>
            <DropdownLink href="/dashboard">
              <template #icon>
                <svg class="mr-3 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m12 14 4-4"/>
                  <path d="M3.34 19a10 10 0 1 1 17.32 0"/>
                </svg>
                Dashboard
              </template>
            </DropdownLink>

            <DropdownLink :href="route('profile.edit')">
              <template #icon>
                <svg class="mr-3 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11.5 15H7a4 4 0 0 0-4 4v2"/>
                  <path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
                  <circle cx="10" cy="7" r="4"/>
                </svg>
                Edit Profile
              </template>
            </DropdownLink>

            <DropdownLink
              :href="route('logout')"
              method="post"
              as="button"
              @click.prevent="handleLogout"
            >
              <template #icon>
                <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Logout
              </template>
            </DropdownLink>
          </template>
        </Dropdown>

        <!-- Botón de Login si no está autenticado -->
        <a v-else href="/dashboard">
          <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            Login
          </button>
        </a>
      </div>
    </div>
  </header>
</template>
