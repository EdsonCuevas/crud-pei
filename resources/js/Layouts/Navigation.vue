<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-blue-500 md:block flex-shrink-0">
    <div class="py-4 text-white">
      <Link class="ml-6 text-lg font-bold text-gray-100" :href="route('dashboard')">
      Panel Coordinador
      
      </Link>

      <ul class="mt-6">
        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-programs.index')" :active="route().current('coord-programs.index')">
          <template #icon>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
              stroke-width="2" 
              stroke="currentColor" 
              class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.75A1.5 1.5 0 014.5 5h15a1.5 1.5 0 011.5 1.5v12A1.5 1.5 0 0119.5 
              20h-15A1.5 1.5 0 013 
              18.5v-12zM3 8.25v10.5m18-10.5v10.5M8.25 5.25H5.75a.75.75 0 00-.75.75v.75h4.5v-.75a.75.75 0 
              00-.75-.75zm10.5 0h-2.5a.75.75 0 00-.75.75v.75h4.5v-.75a.75.75 0 00-.75-.75z" />
              </svg>
          </template>
            Programas
          </NavLink>
        </li>

        

        <li class="relative px-6 py-3">
          <NavLink :href="route('coord-reports.index')" ::active="route().current('about')">
            <template #icon>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" 
                d="M4 12h2v8H4v-8zm4-2h2v10H8V10zm4-4h2v14h-2V6zm4-6h2v20h-2V0z" />
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
