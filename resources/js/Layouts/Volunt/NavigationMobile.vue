<template>
  <transition enter-active-class="transition ease-in-out duration-150" enter-from-class="opacity-0"
    enter-to-class="opacity-100" leave-active-class="transition ease-in-out duration-150" leave-from-class="opacity-100"
    leave-to-class="opacity-0">
    <div v-show="$page.props.showingMobileMenu"
      class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
  </transition>
  <transition enter-active-class="transition ease-in-out duration-150"
    enter-from-class="opacity-0 transform -translate-x-20" enter-to-class="opacity-100"
    leave-active-class="transition ease-in-out duration-150" leave-from-class="opacity-100"
    leave-to-class="opacity-0 transform -translate-x-20">
    <aside v-show="$page.props.showingMobileMenu"
      class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-blue-500 md:hidden">
      <div class="py-4 text-white">
        <Link class="ml-6 text-lg font-bold" :href="route('volunt-programas.index')">
        Fundación CTI
        </Link>

        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('volunt-programas.index')" :active="route().current('volunt-programas.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                  </path>
                </svg>
              </template>
              Programas
            </ResponsiveNavLink>
          </li>

          <li class="relative px-6 py-3">
            <ResponsiveNavLink :href="route('volunt-contactos.index')" :active="route().current('volunt-contactos.index')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                  </path>
                </svg>
              </template>
              Contactos
            </ResponsiveNavLink>
          </li>
        </ul>
      </div>
    </aside>
  </transition>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

let showingTwoLevelMenu = ref(false)
</script>
