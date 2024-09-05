<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-blue-500 md:block flex-shrink-0">
    <div class="py-4 text-white">
      <Link class="ml-6 text-lg font-bold text-gray-100" :href="route('dashboard')">
      Panel Admin
      </Link>

      <ul class="mt-6">
        <li class="relative px-6 py-3">
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
              </svg>
            </template>
            Dashboard
          </NavLink>
        </li>

        <li class="relative px-6 py-3">
          <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
            aria-haspopup="true">
            <span class="inline-flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
              </svg>
              <span class="ml-4">Usuarios</span>
            </span>
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
          <ul
            v-show="showingTwoLevelMenu || route().current('coordinators.index') || route().current('volunteers.index') || route().current('donors.index') || route().current('beneficiaries.index')"
            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50"
            aria-label="submenu">
            
            <li
              :class="{'text-gray-900': route().current('coordinators.index')}"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
              <NavLink :href="route('coordinators.index')" :active="route().current('coordinators.index')">
                Coordinadores
              </NavLink>
            </li>

            <li
              :class="{'text-gray-900': route().current('volunteers.index')}"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
              <NavLink :href="route('volunteers.index')" :active="route().current('volunteers.index')">
                Voluntarios
              </NavLink>
            </li>

            <li
              :class="{'text-gray-900': route().current('donors.index')}"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
              <NavLink :href="route('donors.index')" :active="route().current('donors.index')">
                Donadores
              </NavLink>
            </li>

            <li
              :class="{'text-gray-900': route().current('beneficiaries.index')}"
              class="px-2 py-1 transition-colors duration-150 hover:text-gray-900">
              <NavLink :href="route('beneficiaries.index')" :active="route().current('beneficiaries.index')">
                Beneficiarios
              </NavLink>
            </li>

          </ul>
        </li>

        <li class="relative px-6 py-3">
          <NavLink :href="route('about')" :active="route().current('about')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                </path>
              </svg>
            </template>
            Reportes
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
