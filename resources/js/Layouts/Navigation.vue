<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-blue-500 md:block flex-shrink-0">
    <div class="py-4 text-white">
      <Link class="ml-6 text-lg font-bold text-gray-100" :href="route('dashboard')">
      Panel Donadores
      </Link>

      <ul class="mt-6">
        <li class="relative px-6 py-3">
          <NavLink :href="route('voluntarios.index')" :active="route().current('voluntarios.index')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
              </svg>
            </template>
            Donaciones
          </NavLink>
        </li>
        <li class="relative px-6 py-3">
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
              </svg>
            </template>
            Informes
          </NavLink>
        </li>

        <li class="relative px-6 py-3">
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                </path>
              </svg>
            </template>
            Contactos
          </NavLink>
        </li>

      </ul>
    </div>
  </aside>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
  components: {
    NavLink,
    Link,
  },

  setup() {
    let showingTwoLevelMenu = ref(false)

    return {
      showingTwoLevelMenu
    }
  },
}
</script>
